 <div class="starRating grid_4">
            <label>Rate this video:</label>
            <div>
              <?=Form::radio('starRating', '1', Controller_VideoRatings::getUserRating($openVideo->id) == 1 ); ?>
              <?=Form::radio('starRating', '2', Controller_VideoRatings::getUserRating($openVideo->id) == 2 ); ?>
              <?=Form::radio('starRating', '3', Controller_VideoRatings::getUserRating($openVideo->id) == 3 ); ?>
              <?=Form::radio('starRating', '4', Controller_VideoRatings::getUserRating($openVideo->id) == 4 ); ?>
              <?=Form::radio('starRating', '5', Controller_VideoRatings::getUserRating($openVideo->id) == 5 ); ?>
            </div>
            <input type="submit" name="filterSubmit" value="Submit" id="filterSubmit" />
          </div>
