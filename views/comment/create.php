{{ include('layouts/header.php', {title:'Comment Create'})}}
<div class="container">
    <form method="post">
        <h2>New comment</h2><br>
        <label>Message<br>
            <textarea id="message" name="message" rows="4" cols="50" value="{{comment.message}}"></textarea>
        </label>
        {% if errors.message is defined %}
        <span class="error"> {{errors.message}}</span>
        {% endif %}
        <label>Date
            <input type="date" id="date" name="date" value="{{comment.date}}">
        </label>
        {% if errors.date is defined %}
        <span class="error"> {{errors.email}}</span>
        {% endif %}
        <label>User
               <select name="users_id">
                {% for user in users %}
                <option value="{{ user.id}}">{{ user.name}}</option>
                {% endfor %}
                </select>
            </label>
            <label>Article
               <select name="articles_id">
                {% for article in articles %}
                <option value="{{ article.id}}">{{ article.name}}</option>
                {% endfor %}
                </select>
            </label>
        <input type="submit" value="Save" class="btn">
    </form>
</div>
{{ include('layouts/footer.php')}}