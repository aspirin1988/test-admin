<?php

    namespace App;

    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class NewsAuthorsRelation extends Model
    {
        public function getAuthor(  )
        {
            $this->UserData =  User::where('id',$this->user_id)->first();
        }
    }
