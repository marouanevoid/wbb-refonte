<section class="bar-finder">
    <div class="container">

        <img class="finder-arrow" src="images/misc/finder.arrow.png" alt="finder.arrow" width="32" height="15"/>

        <div class="twelve columns">

            <a class="finder-close"></a>

            <form action="search.php">
                <table>
                    <tr>
                        <td rowspan="2">
                            <h2>Find Your<br/>Best Bar</h2>
                        </td>
                        <td><h3>City</h3></td>
                        <td></td>
                        <td><h3>To go out with</h3></td>
                        <td></td>
                        <td colspan="3"><h3>Mood</h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <select class="ui-dropdown dark" name="city" data-class="with-icon city">
                                <option disabled="disabled">Choose a City</option>
                                <option value="cty2">City 2</option>
                                <option value="cty3">City 3</option>
                                <option value="cty4">City 4</option>
                                <option value="cty5">City 5</option>
                                <option value="cty6">City 6</option>
                            </select>
                        </td>
                        <td><img src="images/misc/chevron.png" alt="chevron" width="8" height="13"/></td>
                        <td>
                            <select class="ui-dropdown dark" name="go_out" data-class="with-icon friend">
                                <option selected="selected">Friends</option>
                                <option>Familly</option>
                                <option>Wife</option>
                                <option>Kids</option>
                                <option>Mother</option>
                            </select>
                        </td>
                        <td><img src="images/misc/chevron.png" alt="chevron" width="8" height="13"/></td>
                        <td>
                            <input type="radio" name="mood" value="chillout" class="ui-radio dark with-icon" data-color="brown" checked="checked"/>
                        <td>
                            <input type="radio" name="mood" value="casual" class="ui-radio dark with-icon"/>
                        </td>
                        <td>
                            <input type="radio" name="mood" value="party" class="ui-radio dark with-icon"/>
                        </td>
                        <td>
                            <input type="submit" class="btn-radius border brown go" value="GO"/>
                        </td>
                    </tr>
                </table>
            </form>

        </div>

    </div>
</section>