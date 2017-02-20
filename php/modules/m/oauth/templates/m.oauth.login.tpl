<form data-ajax="false" action="<?php echo URL.'?'.$_SERVER['QUERY_STRING']?>" method="post">
    <ul data-role="listview" data-inset="true">
        <li data-role="fieldcontain">
            <label for="email">อีเมล์:</label>
            <input type="email" name="email" id="email" value="" data-clear-btn="true">
        </li>
        <li data-role="fieldcontain">
            <label for="email">รหัสผ่าน:</label>
            <input type="password" name="password" id="password" value="" data-clear-btn="true">
            <input type="hidden" name="type" value="login">
        </li>
        <li data-role="fieldcontain">
            <label for="aways">เข้าสู่ระบบอัตโนมัติ:</label>
            <select name="aways" id="aways" data-role="slider">
                <option value="0">ไม่ใช่</option>
                <option value="1">ใช่</option>
            </select>
        </li>
        <li class="ui-body ui-body-b">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-a"><button type="submit" data-theme="a">เข้าระบบ</button></div>
                    <!--div class="ui-block-b"><button type="button" data-theme="d">ลืมรหัสผ่าน</button></div-->
            </fieldset>
        </li>
    </ul>
</form>