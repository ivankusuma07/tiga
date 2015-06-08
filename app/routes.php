<?php
Routes::get('/defer',function(){
  echo "aku cah telat";die();
})->defer('wp_head');


Routes::get('/exit',function(){
  echo "langsung exit";
})->end();


Routes::get('/form/','FormController@index');
Routes::post('/form/process','FormController@process');

Routes::get('/dashboard/posts/','PostController@index');
Routes::get('/dashboard/posts/{pagenum:num?}/','PostController@index');
Routes::get('/dashboard/posts/add/','PostController@add');
Routes::post('/dashboard/posts/create/','PostController@create');
Routes::get('/dashboard/posts/{id:num}/edit/','PostController@edit');
Routes::post('/dashboard/posts/{id:num}/update/','PostController@update');
Routes::post('/dashboard/posts/{id:num}/delete/','PostController@delete');

Routes::get('/request-form', function(){

    echo "<p>".tiga_asset("todi.css")."</p>";;

    $data = array(
        'key_get_0'=>'val',
        'key_get_1'=>'val1',
        'key_get_2'=>'val2',
      );

    $urlPost = tiga_url("/request-process",$data);

     echo "<p>{$urlPost}</p>"

  ?>

  <form method='POST' action='<?php echo tiga_url("/request-process",$data)?>'>
      <input type='text' name='sehat' value=''>
      <input type='submit'value='Submit'>
      <input type='hidden' value='valuePost1' name='key1'>
      <input type='hidden' value='valuePost2' name='key2'>
      <input type='hidden' value='valuePost3' name='key3'>
  </form>

  <?php
});

Routes::post('/request-process', function(){

  echo "<p>".Request::input('key1')."</p>";
  echo "<p>".Request::input('key2')."</p>";
  echo "<p>".Request::input('key3')."</p>";
  echo "<p>".Request::input('key_get_0')."</p>";
  echo "<p>".Request::input('key_get_1')."</p>";
  echo "<p>".Request::input('key_get_2')."</p>";
  
  echo "<p>".Request::has('key_get_2')."</p>";
  echo "<p>".Request::has('key_get_ss2')."</p>";



});


Routes::get('/db', function(){

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
      ->where("ID",'>=',0)
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

Routes::get('/db2',function(){
    
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

Routes::get('/db-insert',function(){
    
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

Routes::get('/db-update',function(){
    
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

Routes::get('/db-delete',function(){
    
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

Routes::get('/db-raw',function(){
    
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
      ->select(DB::raw(' COUNT(*) as count'));

      $results = $hasile2->row();

      $query = $hasile2->getCompiledQuery();

      echo "<p>$query</p>";
        
      echo "<p>count : $results->count </p>";

});

Routes::get('/db-bind',function(){
    
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


Routes::get('/db-join',function(){
  echo "<h4>Join</h4>";

  $join1 = DB::table('wp_posts')
            ->select(DB::raw('wp_posts.post_title as post_title,wp_users.user_login as user_login'))
            ->join('wp_users','wp_posts.post_author','=','wp_users.ID',"LEFT OUTER")
            ->join('wp_postmeta','wp_posts.ID','=','wp_postmeta.post_id',"LEFT OUTER")
            ->limit(5);

              
  $result = $join1->get();            

  echo "<p>Compiled Query : {$join1->getCompiledQuery()}</p>";


  foreach ($result as $row) {
    echo "<p>{$row->user_login}|{$row->post_title}</p>";
  }

  echo "<h4>Join with Raw 2</h4>";

  $join1 = DB::table('wp_posts')
            ->select(array('wp_posts.post_title,wp_users.user_login'))
            ->join('wp_users','wp_posts.post_author','=','wp_users.ID',"LEFT OUTER")
            ->join('wp_postmeta','wp_posts.ID','=','wp_postmeta.post_id',"LEFT OUTER")
            ->limit(5);

              
  $result = $join1->get();            

  echo "<p>Compiled Query : {$join1->getCompiledQuery()}</p>";


  foreach ($result as $row) {
    echo "<p>{$row->user_login}|{$row->post_title}</p>";
  }

  echo "<h4>Join with Raw 3</h4>";

  $join1 = DB::table('wp_posts')
            ->select(array('wp_posts.post_title,wp_users.user_login'))
            ->join(DB::raw("
                LEFT OUTER JOIN wp_users on wp_posts.post_author = wp_users.ID 
                LEFT OUTER JOIN wp_postmeta on wp_posts.ID = wp_postmeta.post_id 
              "))
            ->limit(5);

  $result = $join1->get();            

  echo "<p>Compiled Query : {$join1->getCompiledQuery()}</p>";


  foreach ($result as $row) {
    echo "<p>{$row->user_login}|{$row->post_title}</p>";
  }

  echo "<h4>Join with Raw 4</h4>";

  $join1 = DB::table('wp_posts')
            ->select(array('wp_posts.post_title,wp_users.user_login'))
            ->join(DB::raw("
                LEFT OUTER JOIN wp_users on wp_posts.post_author = wp_users.ID 
              "))
            ->join('wp_postmeta','wp_posts.ID','=','wp_postmeta.post_id',"LEFT OUTER")
            ->limit(5);

  $result = $join1->get();            

  echo "<p>Compiled Query : {$join1->getCompiledQuery()}</p>";


  foreach ($result as $row) {
    echo "<p>{$row->user_login}|{$row->post_title}</p>";
  }
});

Routes::get('/halo/php/{kamu:any}', function($kamu){
	 
   // return Response::json(array('adasd'=>'asdasd'));
    // Response::redirect("http://tonjoo.com");
    Response::download("/home/todiadiyatmo/htdocs/wp_router/wp-content/plugins/tiga/tiga-framework.php");

    // Template::setTitle('Todi');

    // return Response::template('eringga.php',array('name'=>$kamu));


});

Routes::get('/halo/h2o/{kamu:@any}', function($kamu){


	return Response::template('page.tpl',array(
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

Routes::get('/{id:@num}/{name:@any}', 'HomeController@named');

// Routes::get('/db', 'TestController');

Routes::get('/bench',function(){
	Template::render('default.php');
});

Routes::get('/haris',function(){
    echo "haris";
});

Routes::get('/session',function(){

  // Destroy Session
  if(isset($_GET['destroy'])){

    Session::invalidate();

    die();

  }

  echo "<h4>Session</h4>";

  if(isset($_GET['set'])){

    Session::set('name','drag');

    die();

  }

   if(isset($_GET['delete'])){

    Session::set('name','drag');

    Session::remove('name');

  }

  

  echo "<p>has `name` : ". Session::has('name')."</p>";

  echo "<p> name ".Session::get('name')."</p>";

});

Routes::get('/flash',function(){
    echo "Hi, I'am Flash !";
    if(isset($_GET['add'])) {
      // add flash messages
      Flash::add(
          'warning',
          'Your config file is writable, it should be set read-only'
      );
    }

    if(isset($_GET['set'])) {
      
      Flash::set(
          'warning',
          array(
            'Your config file is writable, it should be set read-only',
            'Your second message'
            )
      );

    }

    if(isset($_GET['get'])) {


      foreach (Flash::all() as  $type => $messages) {
          foreach ($messages as $message) {
              echo "<p>{$type} - $message</p>"; 
          }
      }
      
    }


    if(isset($_GET['peek'])) {
      foreach (Flash::peekAll() as $type => $messages) {
          foreach ($messages as $message) {
              echo "<p>{$type} - $message</p>"; 
          }
      }
    }

});