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

}