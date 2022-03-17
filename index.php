    <?php
    include_once('layouts/header.php');

    $secret_key  = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

    function encrypt($data,$key){
        $encription_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encripted = openssl_encrypt($data,'aes-256-cbc',$encription_key,0,$iv);
        return base64_encode($encripted.'::'.$iv);
    }

    function decrypt($data, $key) {

        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);

    }


    if (isset($_POST['submit'])){
        if (isset($_POST['encrypt'])){
            $var = $_POST['encrypt'];
            $encripted_data = encrypt($var,$secret_key);
            echo "Şifrələnmiş mətn: ".'<p>'.$encripted_data.'</p>';

        }elseif (isset($_POST['decrypt'])){
            $var = $_POST['decrypt'];
            $decripted_data = decrypt($var,$secret_key);
            echo "Deşifrələnmiş mətn: ".'<p>'.$decripted_data.'</p>';

        }else{
            echo "Məlumat yoxdur ";
        }

    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="post">
                    <div class="form-group">
                        <label for="foo">Mətni daxil edin</label>
                        <textarea required class="form-control" name="encrypt" ></textarea>

                    </div>
                    <button type="submit" name="submit" class="btn btn-outline-primary">Şifrələ</button>
                </form>
            </div>
            <div class="col">
                <form method="post">
                    <div class="form-group">
                        <label for="foo">Şifrələnmiş mətni daxil edin</label>
                        <textarea required class="form-control" name="decrypt" ></textarea>

                    </div>
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Deşifrələ</button>
                </form>
            </div>
        </div>
    </div>



    <?php include_once('layouts/footer.php'); ?>


