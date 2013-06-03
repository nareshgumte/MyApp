<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'] . '/';
$url=$protocol.$domainName.Yii::app()->baseUrl;
?>
<div id="fb-root"></div>
<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">

    // appId: "327963737297629", //fb_id, 

    $().ready(function() {
        //facebook invite friend


        (function(d) {
            var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }(document));
        $('.connect_facebook').click(function(e) {
            // alert("sadf");
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log(response)
                    //ajax
                    parent.location = "/IntroPoc/ManageFriends/FacebookFriends";
                }
            }, {scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'});
        });

        window.fbAsyncInit = function() {
            FB.init({
                appId: <?php echo Yii::app()->params['fb_api_key']; ?>, cookie: true,
                status: true, xfbml: true, oauth: true
            });
        };
    });
    function close() {
        self.close();
    }
    

</script>
<?php
$type = $_GET['type'];

switch ($type) {
    case "facebook":
        //echo '<script type="text/javascript">sendNotification()</script>';
        ?>
        <script type="text/javascript">
            sendNotification();
            function sendNotification() {
                                
                var ipath1 = "<?php echo $url;?>/site/acceptInvitation?request_ids=<?php echo $_GET['id']; ?>";
                FB.init({
                    appId: <?php echo Yii::app()->params['fb_api_key']; ?>,
                    frictionlessRequests: true,
                    cookie: true,
                    status: true, xfbml: true, oauth: true

                });
                FB.ui(
                {
                    method: 'send', //'feed',//'apprequests', "send"//method: 'stream.publish',"stream.share"
                    to: <?php echo $_GET['id']; ?>, //"100000508717994", //'pranay.kumar.39545', 
                    max_recipients:1,
                    //  show_error: true,
                    message: "You Got an invitation to join the Intropost network",
                    link: ipath1
                                   
                },
                function(response) {
                    // alert("Message sent")
                    self.close();
                    window.close();
                    console.log(response)
                    if (response && response.post_id) {
                        //  alert('Posted!');
                    } else {
                        //  alert(' NOT Posted!');
                    }
                }
            );

            }
                                           

        </script>

        <?php
        exit;
        break;
    case "linkedin":
        header("Location:" . Yii::app()->request->baseUrl . "?lType=message&to=" . $_GET['id']);
        break;
    case "linked":
        echo "Message sent successfully  <input type=\"button\" value=\"Close 'myWindow'\" onclick=\"close()\">";
        exit;
        break;
    case "linkedFailed":
        echo 'Messsage sending failed<a href="#" onclick="close();">close</a>';
        exit;
    default:
        break;
}
?>
