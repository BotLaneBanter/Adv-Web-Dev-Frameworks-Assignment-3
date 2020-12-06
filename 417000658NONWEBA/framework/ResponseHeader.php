<?php 

namespace QuwisSystem\Framework;

class ResponseHeader extends Response_Abstract{


    public function addEntries(array $entries) : bool{

        //If entry is empty, return false
        if(empty($entries)){
         return false;
        }

        foreach($entries as $value){
            $this->data[] = $value;
        }
        return true;


    }

    //Entry IDs correspond with array positions and start at ZERO '0'
    public function showEntry(int $i) : string{

        //If no entries are stored, return false
        if(empty($this->data)){

            return false;

        }

        //If entry id is out of range, return false
       if( $i < 0 || $i > (count($this->data)-1) ){

            return false;

        }
        
        return $this->data[$i];

    }

    //Entry IDs correspond with array positions and start at ZERO '0'
    public function showEntries(int $start, int $end) : string{

         //If no entries are stored, return false
       if(empty($this->data)){

            return false;

        }

        //If entry id is out of range, return false
       if( $start < 0 || $start > (count($this->data)-1) ){

            return false;

        }
        //If entry id is out of range, return false
       if( $end < 0 || $end > (count($this->data)-1) ){

           return false;

        }
        //If start is greater than end return false
       if( $start > $end){

           return false;

        }

        //Push back data entries into output array to be returned as a string
        $output = [];
        $sep = '<br>';

        for($i = $start; $i <= $end; $i++){

            $output[] = $this->data[$i];

        }
        
        return implode($sep, $output);

    }


}

?>