{{ include('layouts/header.php', {title:'Comment Edit'})}}
    <div class="container">
        <form method="post">
            <h2>Edit comment</h2><br>
            <label>Message<br>
            <textarea id="message" name="message" rows="4" cols="50" value="{{comment.message}}"></textarea>
        </label>
        {% if errors.message is defined %}
        <span class="error"> {{errors.message}}</span>
        {% endif %}
            <input type="submit" value="Save"class="btn">
        </form>
    </div>
    {{ include('layouts/footer.php')}}