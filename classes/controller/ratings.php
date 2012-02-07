<?

abstract class Controller_Ratings extends Controller {
   
   protected static $__CLASS__ = __CLASS__;
   
   public function action_storeRating($object_id, $userRating) {
     $class = substr(get_class($this), 11);
     $ratings =  new $class;
     $ratings->storeRating($object_id, $userRating);
   }

}
