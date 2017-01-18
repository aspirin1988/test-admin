<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class News extends Model
    {
        public function getAuthors()
        {
            $data = NewsAuthorsRelation::where( 'object_id', $this->id )->get();
            foreach($data as $key=>$value){
                $data[$key]->getAuthor();
            }

            $this->Authors = $data;
        }
    }
