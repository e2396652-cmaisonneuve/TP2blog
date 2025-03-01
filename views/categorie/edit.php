{{ include('layouts/header.php', {title:'Categorie Edit'})}}
<div class="container">
    <form method="post">
        <h2>Edit categorie</h2><br>
        <label>Name
            <input type="text" name="name" value="{{categorie.name}}">
        </label>
        {% if errors.name is defined %}
        <span class="error"> {{errors.name}}</span>
        {% endif %}
        <input type="submit" value="Save" class="btn">
    </form>
</div>
{{ include('layouts/footer.php')}}