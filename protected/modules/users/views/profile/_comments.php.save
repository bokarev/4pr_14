<?php foreach($comments as $comment): 
if($comment->task_id == $task){?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	<?php //TODO_WUD : ! [comments] echo $comment->task_id  ?>

	<div class="author">
		<?php echo date('F j, Y \a\t h:i a',$comment->create_time) . " [" . $comment->commentStatus->title . "] <br /><b>". $comment->authorLink; ?>  ответил:</b>
                <br /><br />
        </div>


	<div class="content">
		<?php if(substr_count(CHtml::encode($comment->content), 'youtube.com/watch')==1)
                    {
                        if(substr_count(CHtml::encode($comment->content), 'list')==1){
                            $comment->content = preg_replace('/.*list=([^&]*)&.*/', '$1', $comment->content);
                            $comment->content = '<iframe width="706" height="397" src="//www.youtube.com/embed/?listType=playlist&list=' . $comment->content . '&showinfo=1" frameborder="0" allowfullscreen></iframe>';                   
                        }else{
                            $comment->content = str_replace('http://youtube.com','http://www.youtube.com',$comment->content);
                            $comment->content = str_replace('http://www.youtube.com/watch?v=', '<iframe width="706" height="397" src="http://www.youtube.com/embed/', $comment->content);
                            $comment->content .= '" frameborder="0" allowfullscreen></iframe>';
                        }                       
                        echo $comment->content;                       
                        //  <iframe width="640" height="360" src="//www.youtube.com/embed/?listType=playlist&list=PLVBkQAPTrCOpOh1aNUbEi7lSiAWzOpkyr&showinfo=1" frameborder="0" allowfullscreen></iframe>                       
                    }
                    else 
                        echo  nl2br(CHtml::encode($comment->content)); ?>
            
            <hr />
	</div>

</div><!-- comment -->
<?php } endforeach; ?>