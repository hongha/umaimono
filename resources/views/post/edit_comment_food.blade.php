<?php use App\User; ?>
<li>
  <div class="comment-main-level">
    <!-- Avatar -->
    <div class="comment-avatar">
    <?php $comment_user = User::where('id',$comment_food->id_user)->get(); 
    foreach ($comment_user as $comment_user) {} ?>
    <img src="{{ URL::asset('avatar/'.$comment_user->avatar) }}" alt="">
    </div>
    <!-- Contenedor del Comentario -->
    <div class="comment-box">
      <div class="comment-head">
        <h6 class="comment-name"><a href="{{url('user/view/'.$comment_food->id_user)}}">{{$comment_user->name}}</a></h6>
        <span>{{$comment_food->created_at}}</span>
        <?php if(isset(Auth::user()->id)){
        if(Auth::user()->id == $comment_food->id_user){ ?>
        <a href="javascript:void(0)" onclick="deleteComment({{$comment_food->id}},this)"><i class="fa fa-trash-o"></i></a>
        <a href="javascript:void(0)" onclick="loadEditComment({{$comment_food->id}},this)"><i class="fa fa-pencil"></i></a>                     
        <?php }}?>
      </div>
      <div class="comment-content">
        <span>{{$comment_food->content}}</span><br><br>
        <a href="" style="font-size: 14px;"><span>Thích</span></a>&nbsp;<span style="font-size: 14px;">20</span>&nbsp;&nbsp;<a href="" style="font-size: 14px;"><span>Trả lời</span></a>&nbsp;<span style="font-size: 14px;">20</span>
      </div>
    </div>
  </div>
</li>