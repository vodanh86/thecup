<?php
namespace App\Admin\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;

final class Util {

    static function createSlug($title, $allSlugs){
        $slug = Str::slug($title);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        $i = 0;
        do {
            $i = $i + 1;
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        } while (TRUE);
    }

    static function getCat($catId){
        $cat = Category::find($catId);
        $parentCat = Category::find($cat->parent_id);
        
        if ($parentCat->parent_id == 0){
            return $cat->title;
        } 
        
        return $parentCat->title." - ".$cat->title;
    }

    static function vnDateFormat($orgDate){
        $newDate = Carbon::parse($orgDate);  
        return "Ngày $newDate->day tháng $newDate->month, $newDate->year";  
    }

    static function dateFormat($orgDate){
        $newDate = Carbon::parse($orgDate);  
        return $newDate->format('d/m/Y');
    }

    static function dateTimeFormat($orgDate){
        $newDate = Carbon::parse($orgDate);  
        return $newDate->format('h:m:s d/m/Y');
    }

    static function fullTextWildcards($term)
   {
       // removing symbols used by MySQL
       $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
       $term = str_replace($reservedSymbols, '', $term);

       $words = explode(' ', $term);

       foreach ($words as $key => $word) {
           /*
            * applying + operator (required word) only big words
            * because smaller ones are not indexed by mysql
            */
           if (strlen($word) >= 1) {
               $words[$key] = '+' . $word  . '*';
           }
       }
       
       $searchTerm = implode(' ', $words);

       return $searchTerm;
   }

   static function checkHash(){
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        //$secureHash = md5($vnp_HashSecret . $hashData);
        $secureHash = hash('sha256',env('vnp_HashSecret') . $hashData);
        return ($secureHash == $vnp_SecureHash);
   }

   static function cutContent($content){
       $newContent = substr($content, 0, strlen($content)/2) ."....";
       return $newContent;
   }

   static function curl_get_file_size( $url ) {
        // Assume failure.
        $result = -1;
    
        $curl = curl_init( $url );
    
        // Issue a HEAD request and follow any redirects.
        curl_setopt( $curl, CURLOPT_NOBODY, true );
        curl_setopt( $curl, CURLOPT_HEADER, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
        //curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );
    
        $data = curl_exec( $curl );
        curl_close( $curl );
    
        if( $data ) {
        $content_length = "unknown";
        $status = "unknown";
    
        if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
            $status = (int)$matches[1];
        }
    
        if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
            $content_length = (int)$matches[1];
        }
    
        // http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
        if( $status == 200 || ($status > 300 && $status <= 308) ) {
            $result = $content_length;
        }
        }
    
        return $result;
    }
    
    static function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}