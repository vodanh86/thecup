<div class="podcast-player-holder">
    <div class="upper">
        <span class="podcast-title">Hài lòng với nhưng thứ đã có sẽ làm bạn hạnh phúc hơn</span>
        <div class="dot-seperator"></div>
        <span class="podcast-name" id="track">Phần 2: Quẳng gánh lo đi mà sống</span>
    </div>
    <div class="divider"></div>
    <div class="lower">
        <div class="container">
            <div class="row">
                <div class="col-md-6 button-holder">
                    <button class="btn">
                        <span class="material-icons smaterial-icons-outlined">playlist_play</span>
                    </button>
                    <button class="btn btn-speed" id="speedBtn1X">
                        <span class="play-speed">1X</span>
                    </button>
                    <button class="btn volume-holder">
                        <span class="material-icons material-icons-outlined" id="volumeHolder">volume_up</span>
                        <div class="volume-bar" id="volumeProgressWrapper" style="display: none">
                            <input type="range" min="0" max="100" value="80" class="slider" id="volProgress">
                        </div>
                    </button>
                    <button class="btn" id="prevBtn">
                        <span class="material-icons material-icons-outlined">skip_previous</span>
                    </button>
                    <button id="replay10s" class="btn">
                        <span class="material-icons material-icons-outlined">replay_10</span>
                    </button>
                    <button class="btn play-button" id="playBtn">
                       <span class="material-icons material-icons-outlined">
                        play_arrow
                        </span>
                    </button>
                    <button id="forward10s" class="btn">
                        <span class="material-icons material-icons-outlined">forward_10</span>
                    </button>
                    <button class="btn" id="nextBtn">
                        <span class="material-icons material-icons-outlined">skip_next</span>
                    </button>
                </div>
                <div class="col-md-6 progress-holder">
                    <span id="timer" class="time-played">0:00</span>
                    <div class="prog" id="durationProgressWrapper">
                        <input type="range" min="0" max="100" value="0" class="slider" id="progress">
                    </div>
                    <span id="duration" class="total-time">0:00</span>
                </div>
            </div>
        </div>
    </div>
</div>