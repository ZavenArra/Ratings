<?

abstract class Controller_Ratings extends Controller {
   
   protected static $__CLASS__ = __CLASS__;
   
   protected static $objectTable = 'objects';
   
   protected $ratings = null;
   
   public static function Factory($class){
      
      $class = $class.'_Controller';
      return new $class;
   }

   private static function getObjectTypeId(){
      $ratingsObjectType = ORM::Factory('ratingsobjecttype')->where('object_type', '=', self::$objectTable )->find();
      if(!$ratingsObjectType->loaded()){
         $ratingsObjectType = ORM::Factory('ratingsobjecttype');
         $ratingsObjectType->object_type = self::$objectTable;
         $ratingsObjectType->save();
      }
      return $ratingsObjectType->id;
      
   }
   
   public function storeRating($object_id, $userRating) {
      
      $objectTypeId = self::getObjectTypeId();
      $user_id = Session::instance()->get('auth_user')->id;
      $rating = ORM::Factory('rating');
			$rating->where('object_id', '=', $object_id);
			$rating->where('object_type_id', '=', $objectTypeId);
			$rating->where('user_id', '=', $user_id );
			$rating->find();
			if($rating->loaded()){
				$rating = ORM::Factory('rating', $rating->id);
			} else {
				$rating = ORM::Factory('rating');
			}

      $rating->object_id = $object_id;
      $rating->rating = $userRating;
      $rating->object_type_id = $objectTypeId;
      $rating->user_id = Session::instance()->get('auth_user')->id;
      $rating->save();
      
   }

   static public function getUserRating($object_id){
      
      
      $objectTypeId = self::getObjectTypeId();
     /* echo '>'.$object_id;
      echo '>'.$objectTypeId;
      echo '>'.Session::instance()->get('auth_user')->id;*/

      $rating = ORM::Factory('rating')
              ->where('object_id', '=', $object_id)
              ->where('object_type_id', '=', $objectTypeId)
              ->where('user_id', '=', Session::instance()->get('auth_user')->id)
              ->find();
      
      return $rating->rating;
   }
   
   public function getAverageRating($id) {
      $ratings = $this->getRatings($id);
      $average = 0;
      if(count($ratings)){
         foreach ($ratings as $rating) {
          $average += $rating->rating;
         }
         $average = $average / count($ratings);
         $average = number_format($average, 1);
      }
      return $average;
      
   }
   
     public function getNumberOfRatings($id) {
      $objectTypeId = self::getObjectTypeId();
      $ratings = $this->getRatings($id);

      
      return count($ratings);
      
   }
   
   private function getRatings($objectId){
      $objectTypeId = self::getObjectTypeId();
      if(!$this->ratings){
       $this->ratings = ORM::Factory('rating')
              ->where('object_id', '=', $objectId)
              ->where('object_type_id', '=', $objectTypeId)
              ->find_all();
      }
       return $this->ratings;
   }
   
   public function report($objectId){
      $view = new View('ratings');
      $ratings = $this->getRatings($objectId);

      $view->averageRating = $this->getAverageRating($objectId);
      $view->numberOfRatings = $this->getNumberOfRatings($objectId);
      return $view->render();
   
   }

}
