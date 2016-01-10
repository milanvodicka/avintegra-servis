<div class="form row">
    <div class="col-md-8 col-md-offset-2">
        <?php if (!empty($message['ok'])): ?>
            <div class="alert alert-success"><?=$message['ok']?></div>
        <?php elseif (!empty($message['error'])): ?>
            <div class="alert alert-danger"><?=$message['error']?></div>
        <?php endif; ?>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Meno a priezvisko</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="_name" id="name" placeholder="Meno a priezvisko">
                </div>
            </div>
            <div class="form-group">
                <label for="street" class="col-sm-4 control-label">Ulica, číslo domu</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="_street" id="street" placeholder="Ulica, číslo domu">
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-4 control-label">Mesto</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="_city" id="city" placeholder="Mesto">
                </div>
            </div>
            <div class="form-group">
                <label for="zip" class="col-sm-4 control-label">PSČ</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="_zip" id="zip" placeholder="PSČ">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-4 control-label">Tel. číslo</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="_phone" id="phone" placeholder="Tel. číslo">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Emailová adresa</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="_email" id="email" placeholder="Emailová adresa">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="checkbox">
                        <label><input type="checkbox" name="_warranty" id="warranty" value="yes"> Záručná oprava</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="text" class="col-sm-4 control-label">Popis poruchy</label>
                <div class="col-sm-8">
                    <textarea name="_text" id="text" class="form-control" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group form__cantsee">
                <label for="cantsee" class="col-sm-4 control-label">Nevypĺňajte</label>
                <div class="col-sm-8">
                    <input type="text" name="_cantsee" id="cantsee" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-default">Odoslať</button>
                </div>
            </div>
        </form>
    </div>
</div>