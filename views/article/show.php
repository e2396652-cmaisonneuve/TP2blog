{{ include('layouts/header.php', {title:'Article'})}}
    <div>
        <h1>Article</h1>
        <p><strong>Title: </strong>{{ article.title }}</p>
        <p><strong>Content: </strong>{{ article.content }}</p>
        <p><strong>Date: </strong>{{ article.date }}</p>
        <a href="{{base}}/article/edit?id={{ article.id }}" class="btn">Edit</a>
    </div>
{{ include('layouts/footer.php')}}