<section class="bar-finder">

    <a class="finder-close"></a>

    <h2>Find Your Best Bar</h2>

    <form action="search.php">

        <h3>City</h3>
        <select class="ui-dropdown dark" name="city" data-class="with-icon city">
            <option disabled="disabled">Choose a City</option>
            <option value="cty2">City 2</option>
            <option value="cty3">City 3</option>
            <option value="cty4">City 4</option>
            <option value="cty5">City 5</option>
            <option value="cty6">City 6</option>
        </select>

        <h3>To go out with</h3>
        <select class="ui-dropdown dark" name="go_out" data-class="with-icon friend">
            <option selected="selected">Friends</option>
            <option>Familly</option>
            <option>Wife</option>
            <option>Kids</option>
            <option>Mother</option>
        </select>

        <h3>Mood</h3>
        <input type="radio" name="mood" value="chillout" class="ui-radio dark with-icon" data-color="brown" checked="checked"/>
        <input type="radio" name="mood" value="casual" class="ui-radio dark with-icon"/>
        <input type="radio" name="mood" value="party" class="ui-radio dark with-icon"/>

        <br/>

        <input type="submit" class="btn-radius border brown go" value="GO"/>

    </form>


</section>