{{ include('layouts/header.php', {title:'Homepage'})}}


<article>
  <div class="post-title">
    <h2>{{article.title}}</h2>
    <div class="categories"><small>Category: {{categorie.name}}</small></div>
  </div>
  <div class="post-content">
    <p>{{article.content}}</p>
  </div>
  <div class="post-footer">
    <div class="post-info">by {{user.name}} (<a href="mailto:">{{user.email}}</a>)</strong> on {{comment.date}}</div>
    <div class="post-edit">Edit</div>
  </div>
  <div class="post-comments">
    <h4>Comments</h4>
    <div class="comment">
      <div class="comment-text">{{comment.message}}</div>
      <div class="comment-info"><small>COMMENT AUTHOR on {{comment.date}}</small></div>
    </div>

  </div>
</article>


{{ include('layouts/footer.php')}}