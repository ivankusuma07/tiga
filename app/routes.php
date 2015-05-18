<?php

Route::get('/db', function(){

    /*
     * Select
     */
    echo "<h4>Test :  Select </h4>";

    $prefix = DB::getConnection()->getPrefix();

    $allPost = DB::select("post_title")
    ->select(array("post_author","post_content"))
    ->table("{$prefix}posts");

    $all = $allPost->get();
    $row = $allPost->row();

    echo "<p>{$all[0]->post_title}</p>";
    echo "<p>{$row->post_title}</p>";

     $author = DB::select("post_author")
    ->select(array("post_author","post_content"))
    ->table("{$prefix}posts")->row();
     echo "<p>{$author->post_author}</p>";

     echo "<b>Query : {$allPost->getCompiledQuery()}</b>";
     /*
      * Join
      */

     echo "<h4>Test :  Join</h4>";

      $postJoin = DB::table("{$prefix}posts")
      ->join("{$prefix}users","{$prefix}posts.post_author","=","{$prefix}users.ID");

      echo "<b>Query : {$postJoin->getCompiledQuery()}</b>";

      $rowJoin = $postJoin->row();

      if($rowJoin){

        echo "<h3>{$rowJoin->post_title}</h3>";
        echo "<p>{$rowJoin->post_content}</p>";

      }

      echo "<b>Query : {$postJoin->getCompiledQuery()}</b>";

      echo "<h4>Test :  Not Found</h4>";

      $postJoin2 = DB::table("{$prefix}posts")
      ->join("{$prefix}users","{$prefix}posts.post_author","=",34235);

      var_dump($postJoin2->row());

      /*
       * Where
       */
      echo "<h4>Test :  Where ID = 1</h4>";

      $postWhere = DB::table("{$prefix}posts")
      ->where("ID",'=',1)
      ->where("post_author",'=',1);

      $where = $postWhere->row();

      echo "<b>Query : {$postWhere->getCompiledQuery()}</b>";

      echo "<p>".$where->post_title."</p>"; 

      echo "<h4>Test :  Where Like = 'pag' </h4>";

      $postWhere2 = DB::table("{$prefix}posts")
      ->like("post_title","%pag%");

      $where2 = $postWhere2->row();

      echo "<b>Query : {$postWhere2->getCompiledQuery()}</b>";

      echo "<p>".$where2->post_title."</p>";

      echo "<h4>Test : Select post meta order by ID ASC, limit 10,offset 5, where ID > 0 + COUNT</h4>";


      $limitOffset = DB::table("{$prefix}usermeta")
      ->where("umeta_id",">=",1)
      ->limit(10)
      ->offset(5)
      ->orderBy('umeta_id','ASC');

      $limitOffsetRow = $limitOffset->row();

      echo "<b>Query : {$limitOffset->getCompiledQuery()}</b>";

      echo "<p>{$limitOffsetRow->umeta_id} {$limitOffsetRow->meta_key}={$limitOffsetRow->meta_value}</p>";

      echo "<b>Query : {$limitOffset->getCompiledQuery()}</b>";

      $limitOffsetResults = $limitOffset->get();

      foreach ($limitOffsetResults as $row) {
        echo "<p>{$row->umeta_id} {$row->meta_key}={$row->meta_value}</p>";
      }


      echo "<b>Query : {$limitOffset->getCompiledQuery()}</b>";


      echo "<p>Row Count {$limitOffset->count()}</p>";

});

Route::get('/db2',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      echo "<h4>Select post meta order by ID ASC, where ID > 0,group by meta_value + COUNT</h4>";

      $limitOffset = DB::table("{$prefix}usermeta")
      ->where("umeta_id",">=",1)
      ->select('umeta_id')
      ->select(array('user_id'))
      ->select('meta_key,meta_value')
      ->groupBy('meta_value')
      ->orderBy('umeta_id','ASC');

      $limitOffsetResults = $limitOffset->get();

      echo "<b>Query : {$limitOffset->getCompiledQuery()}</b>";

      foreach ($limitOffsetResults as $row) {
        echo "<p>{$row->umeta_id} | {$row->meta_key}={$row->meta_value}</p>";
      }

});

Route::get('/db-insert',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      $data = array(
          'user_id'=>1,
          'meta_key'=>'cah anyar 2',
          'meta_value'=>4
        );

      echo "<h4>Insert Data</h4>";


      $hasile = DB::table("{$prefix}usermeta")->insert($data);
      $hasile2 = DB::insert("{$prefix}usermeta",$data);

      var_dump($hasile);
      var_dump($hasile2);

});

Route::get('/db-update',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      $data = array(
          'user_id'=>2,
          'meta_value'=>16,
        );

      echo "<h4>Update Data</h4>";


      $hasile = DB::table("{$prefix}usermeta")->where('meta_key','=','cah anyar 2')->update($data);

      echo "<p>Row Affected : {$hasile}</p>";

      // $data2 = array(
      //     'user_id'=>2,
      //     'meta_key'=>'cah anyar 2',
      //   );


      // echo "<p>Row Affected : {$hasile}</p>"

});

Route::get('/db-delete',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      echo "<h4>Delete Data</h4>";

      $hasile = DB::table("{$prefix}usermeta")->where('meta_key','=','cah anyar 2')->delete();

      echo "<p>Row Affected : {$hasile}</p>";

      // $data2 = array(
      //     'user_id'=>2,
      //     'meta_key'=>'cah anyar 2',
      //   );


      // echo "<p>Row Affected : {$hasile}</p>"

});

Route::get('/db-raw',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      echo "<h4>RAW SELECT</h4>";

      $hasile = DB::table("{$prefix}usermeta")
      ->where(DB::raw("user_id=1 AND user_id !=0"))
      ->where('meta_value','!=','143')
      ->limit(5)
      ->get();

      foreach ($hasile as $row) {
        echo "<p>{$row->umeta_id} - {$row->user_id}|{$row->meta_key}</p>";
      }

      echo "<h4>COUNT -> RAW SELECT</h4>";
      $hasile2 = DB::table("{$prefix}usermeta")
      ->select(DB::raw('COUNT(*) as count'));

      $results = $hasile2->row();

      $query = $hasile2->getCompiledQuery();

      echo "<p>$query</p>";
        
      echo "<p>count : $results->count </p>";

});

Route::get('/db-bind',function(){
    
      $prefix = DB::getConnection()->getPrefix();    

      echo "<h4>BIND PARAMS SELECT</h4>";

      $raw = DB::raw("SELECT * FROM {$prefix}usermeta where user_id=:id_1 and user_id !=:id_0 LIMIT 5");

      $query = DB::query($raw)
                  ->bind(array(
                    ':id_1'=>1,
                    ':id_0'=>0
                  ));

      echo "<p>Before Binding : {$query->getCompiledQuery()}</p>";

      $results = $query->get();

      echo "<p>After Binding : {$query->getCompiledQuery()}</p>";

      foreach ($results as $row) {
        echo "<p>{$row->umeta_id} - {$row->user_id}|{$row->meta_key}</p>";
      }


      echo "<h4>BIND PARAMS INSERT</h4>";

      $raw = DB::raw("INSERT INTO `router2`.`wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, 4, 'lalala', 'lalala');");

      $query = DB::query($raw);

      $results = $query->row();

      echo "<p>Insert ID : $results</p>";

});



Route::get('/halo/php/{kamu:@any}', function($kamu){
	
	// Response::template('eringga.php',array('name'=>$kamu));
    // Response::json(array('adasd'=>'asdasd'));
    // Response::redirect("http://tonjoo.com");
    // Response::download("/home/todiadiyatmo/htdocs/wp_router/wp-content/plugins/lotus-framework/lotus-framework.php");

    // View::setTitle('Todira');

    // Response::template('eringga.php',array('name'=>$kamu));

    Session::set('ads','ads');

});

Route::get('/halo/h2o/{kamu:@any}', function($kamu){


	Response::view('page.tpl',array(
    'users' => array(
        array(
            'username' =>           'peter',
            'tasks' => array('school', 'writing'),
            'user_id' =>            1,
        ),
        array(
            'username' =>           'anton',
            'tasks' => array('go shopping'),
            'user_id' =>            2,
        ),
        array(
            'username' =>           'john doe',
            'tasks' => array('write report', 'call tony', 'meeting with arron'),
            'user_id' =>            3
        ),
        array(
            'username' =>           'foobar',
            'tasks' => array(),
            'user_id' =>            4
        )
    )
));

});

Route::get('/{id:@num}/{name:@any}', 'HomeController@named');

// Route::get('/db', 'TestController');

Route::get('/bench',function(){
	View::render('default.php');
});

Route::get('/haris',function(){
    echo "haris";
});