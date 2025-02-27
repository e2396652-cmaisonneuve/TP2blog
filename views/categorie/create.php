{{ include('layouts/header.php', {title:'Categorie Create'})}}
<div class="container">
    <form method="post">
        <h2>New categorie</h2><br>
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