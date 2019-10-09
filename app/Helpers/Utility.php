<?php

namespace App\Helpers;

use Illuminate\Http\Request;

/**Useful function to be used statically */
class Utility {

    /**
     * Provide author relations to be included based on request
     * @param Request $request
     * @return array array of relations
     */
    public static function getRelationsForAuthor(Request $request){
        return self::getRelations($request, ['quotes']);
    }

    /**
     * Provide category relations to be included based on request
     * @param Request $request
     * @return array array of relations
     */
    public static function getRelationsForCategory(Request $request){
        return self::getRelations($request, ['quotes','categoryQuotes']);
    }

    /**
     * Provide language relations to be included based on request
     * @param Request $request
     * @return array array of relations
     */
    public static function getRelationsForLanguage(Request $request){
        return self::getRelations($request, ['quotes']);
    }

    /**
     * Provide quote relations to be included based on request
     * @param Request $request
     * @return array array of relations
     */
    public static function getRelationsForQuote(Request $request){
        return self::getRelations($request, ['author','language','topics','quoteCategories']);
    }

    private static function getRelations(Request $request, $expectedIncludes){
        $includes=($request->input('include')!==null)?explode(',',$request->input('include')):[];

        $withRelations=array_values(array_intersect($expectedIncludes,$includes));
        return $withRelations;
    }
}
