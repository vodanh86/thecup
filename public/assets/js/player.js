
let playListIsLoaded = false;
let player;
function loadPlaylist(soundObj) {
    //console.log(soundObj.sound[0].id.toString());
    console.log("Da chay vao loadPlaylist");
    var playlist = [];
    var sound = soundObj.sound;
    for (let i = 0; i < sound.length; i++) {
        playlist.push(sound[i]);
    }
    playListIsLoaded = true;
    player = new Player(playlist);
}

/**
 * Player class containing the state of our playlist and where we are in it.
 * Includes all methods for playing, skipping, updating the display, etc.
 * @param {Array} playlist Array of objects with playlist song details ({title, file, howl}).
 */
var Player = function (playlist) {
    this.playlist = playlist;
    this.index = 0;
    console.log("Da chay vao Player");

    // Display the title of the first track.
    if (playListIsLoaded){
        console.log(playlist[0].name);
        track.innerHTML = playlist[0].name;
    } else {
        console.log("Failed to load playlist");
    }
};
Player.prototype = {
    /**
     * Play a song in the playlist.
     * @param  {Number} index Index of the song in the playlist (leave empty to play the first or current).
     */
    play: function (index) {
        var self = this;
        var sound;

        index = typeof index === 'number' ? index : self.index;
        var data = self.playlist[index];

        // If we already loaded this track, use the current one.
        // Otherwise, setup and load a new Howl.
        if (data.howl) {
            sound = data.howl;
        } else {
            sound = data.howl = new Howl({
                src: ['' + self.playlist[index].link],
                format: "mp3",
                html5: true, // Force to HTML5 so that the audio can stream in (best for large files).
                volume: 0.1,
                onplay: function () {
                    // Display the duration.
                    duration.innerHTML = self.formatTime(Math.round(sound.duration()));

                    // Start updating the progress of the track.
                    requestAnimationFrame(self.step.bind(self));

                },
                onload: function () {

                },
                onend: function () {
                    self.skip('next');
                },
                onpause: function () {

                },
                onstop: function () {

                },
                onseek: function () {
                    // Start updating the progress of the track.
                    requestAnimationFrame(self.step.bind(self));
                }
            });
        }

        // Begin playing the sound.
        sound.play();

        // Update the track display.
        track.innerHTML = data.name;

        // Keep track of the index we are currently playing.
        self.index = index;
        console.log("Current index: " +index);
    },

    /**
     * Pause the currently playing track.
     */
    pause: function () {
        var self = this;

        // Get the Howl we want to manipulate.
        var sound = self.playlist[self.index].howl;

        // Puase the sound.
        sound.pause();

        // Show the play button.
        playBtn.style.display = 'inline-flex';
    },

    /**
     * Skip to the next or previous track.
     * @param  {String} direction 'next' or 'prev'.
     */
    skip: function (direction) {
        var self = this;

        // Get the next track based on the direction of the track.
        var index = 0;
        if (direction === 'prev') {
            index = self.index - 1;
            if (index < 0) {
                index = self.playlist.length - 1;
            }
        } else {
            index = self.index + 1;
            if (index >= self.playlist.length) {
                index = 0;
            }
        }
        self.skipTo(index);
    },

    /**
     * Skip to a specific track based on its playlist index.
     * @param  {Number} index Index in the playlist.
     */
    skipTo: function (index) {
        var self = this;

        // Stop the current track.
        if (self.playlist[self.index].howl) {
            self.playlist[self.index].howl.stop();
        }

        // Reset progress.
        progress.value = '0';

        // Play the new track.
        self.play(index);
    },

    /**
     * Set the volume and update the volume slider display.
     * @param  {Number} val Volume between 0 and 1.
     */
    volume: function (val) {
        var self = this;

        // Update the global volume (affecting all Howls).
        Howler.volume(val);

        // Update the display on the slider.
        //volProgress.style.width = val * 100 + '%'
    },
    rate: function (val) {
        var self = this;

        // Get the Howl we want to manipulate.
        var sound = self.playlist[self.index].howl;

        if (sound.playing()) {
            sound.rate(val);
        }
    },
    /**
     * Seek to a new position in the currently playing track.
     * @param  {Number} per Percentage through the song to skip.
     */
    seek: function (per) {
        var self = this;

        // Get the Howl we want to manipulate.
        var sound = self.playlist[self.index].howl;

        // Convert the percent into a seek position.
        if (sound.playing()) {
            sound.seek(sound.duration() * per);
        }
    },
    seekForward10: function () {
        var self = this;
        var sound = self.playlist[self.index].howl;
        var currentSeek = sound.seek();
        var soundDuration = sound.duration();

        sound.seek(currentSeek + 10);
        console.log(currentSeek);
        if (currentSeek >= soundDuration) {
            console.log("Jump to next");
            this.skip('next');
        }

    },
    seekBackward10: function () {
        var self = this;
        var sound = self.playlist[self.index].howl;
        var currentSeek = sound.seek();
        //var soundDuration = sound.duration();

        sound.seek(currentSeek - 10);
        console.log(currentSeek);
        if (currentSeek <= 10) {
            sound.seek(0);
        }

    },

    /**
     * The step called within requestAnimationFrame to update the playback position.
     */
    step: function () {
        var self = this;

        // Get the Howl we want to manipulate.
        var sound = self.playlist[self.index].howl;

        // Determine our current seek position.
        var seek = sound.seek() || 0;
        timer.innerHTML = self.formatTime(Math.round(seek));
        progress.value = (((seek / sound.duration()) * 100) || 0);

        // If the sound is still playing, continue stepping.
        if (sound.playing()) {
            requestAnimationFrame(self.step.bind(self));
        }
    },

    /**
     * Toggle the playlist display on/off.
     */
    togglePlaylist: function () {
        var self = this;
        var display = (playlist.style.display === 'block') ? 'none' : 'block';

        setTimeout(function () {
            playlist.style.display = display;
        }, (display === 'block') ? 0 : 500);
        playlist.className = (display === 'block') ? 'fadein' : 'fadeout';
    },

    /**
     * Format the time from seconds to M:SS.
     * @param  {Number} secs Seconds to format.
     * @return {String}      Formatted time.
     */
    formatTime: function (secs) {
        var minutes = Math.floor(secs / 60) || 0;
        var seconds = (secs - minutes * 60) || 0;

        return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }
};

// Setup our new audio player class and pass it the playlist.


$(document).on('click', '#playAllBtn', function () {
    $('.podcast-player-holder').css("display", "block");
    $('footer').css("margin-top", "0px");
    window.scrollTo(0, document.body.scrollHeight);
});

prevBtn.addEventListener('click', function () {
    player.skip('prev');
    $('#playBtn').find('span').text('pause');
    $('#playBtn').attr('id', 'pauseBtn');

    $('.btn-speed').find('span').text('1X');
    $('.btn-speed').attr('id', 'speedBtn1X');
});
nextBtn.addEventListener('click', function () {
    player.skip('next');
    $('#playBtn').find('span').text('pause');
    $('#playBtn').attr('id', 'pauseBtn');

    $('.btn-speed').find('span').text('1X');
    $('.btn-speed').attr('id', 'speedBtn1X');
});
progress.addEventListener('change', function (event) {
    //console.log(progress.value / 100);
    //console.log(progressWrapper.offsetWidth);
    player.seek(progress.value / 100);
});
progress.addEventListener('click', function (event) {
    var progVal = event.offsetX / progress.offsetWidth;

    if (progVal < 0){
        progVal = 0;
    }
    if (progVal > 1){
        progVal = 1;
    }
    player.seek(progVal);
});
volProgress.addEventListener('change', function (event) {
    //console.log("Volume value: "+ event.offsetX / volumeProgressWrapper.offsetWidth);
    console.log(volProgress.value);
    player.volume(volProgress.value / 100);
});
forward10s.addEventListener('click', function () {
    player.seekForward10();
});
replay10s.addEventListener('click', function () {
    player.seekBackward10();
});

$(document).on('click', '#playBtn', function () {
    console.log("PLAY CALLED!");
    $('#playBtn').find('span').text('pause');
    $('#playBtn').attr('id', 'pauseBtn');
    player.play();
});
$(document).on('click', '#pauseBtn', function () {
    console.log("PAUSE CALLED!");
    $('#pauseBtn').find('span').text('play_arrow');
    $('#pauseBtn').attr('id', 'playBtn');
    player.pause();
});

$(document).on('click', '#volumeHolder', function () {
    console.log("volumeHolder CALLED!");
    if (volumeProgressWrapper.style.display.toString() == 'none') {
        volumeProgressWrapper.style.display = 'flex';
        homePageBody.style.touchAction = 'none';
    } else {
        volumeProgressWrapper.style.display = 'none';
        homePageBody.style.touchAction = 'auto';
    }
});

//Button Speed
$(document).on('click', '#speedBtn1X', function () {
    $('#speedBtn1X').find('span').text('1.5X');
    $('#speedBtn1X').attr('id', 'speedBtn15X');
    player.rate(1.5);
});
$(document).on('click', '#speedBtn15X', function () {
    $('#speedBtn15X').find('span').text('2X');
    $('#speedBtn15X').attr('id', 'speedBtn2X');
    player.rate(2);
});
$(document).on('click', '#speedBtn2X', function () {
    $('#speedBtn2X').find('span').text('1X');
    $('#speedBtn2X').attr('id', 'speedBtn1X');
    player.rate(1);
});