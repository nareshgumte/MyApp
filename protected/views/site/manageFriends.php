
<script type="text/javascript">


    $().ready(function() {
        //facebook invite friend
        window.fbAsyncInit = function() {
            FB.init({
                appId: <?php echo Yii::app()->params['fb_api_key']; ?>, cookie: true,
                status: true, xfbml: true, oauth: true
            });
        };

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


    });
    function send_invitation(fb_frnd_id, username) {
        //                $("#"+fb_frnd_id).removeClass("invite");
        //                $("#"+fb_frnd_id).addClass("invite selected");
        //alert("nares"+fb_frnd_id);

        FB.ui({method: 'apprequests',
            message: "Come check me out on iRant !!!!\nThis is the Social media site that everyone is ranting about." + siteUrl,
            to: fb_frnd_id
        }, function(response) {
            if (response == null) {

            } else {

                alert("Request Sent Successfully");


            }
            //console.log(response);
        });
    }
   
</script>

<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - ManageFriends';
$this->breadcrumbs = array(
    'ManageFriends',
);
?>
<div id="fb-root"></div>

<h1>Contacts</h1>
<?php
echo CHtml::link("ImportFromFacebook", "javascript:void(0)", array("class" => "connect_facebook"));
echo CHtml::link("ImportFromLinkedIn", Yii::app()->request->baseUrl . "?lType=initiate");
echo CHtml::beginForm(CHtml::normalizeUrl(array('site/ManageFriends')), 'get', array('id' => 'filter-form', 'class' => 'form-search'));
echo CHtml::textField('q', (isset($_GET['q'])) ? $_GET['q'] : '', array(
    'id' => 'q',
    'class' => 'input-medium search-query',
    'placeholder' => 'Search',
));
echo CHtml::submitButton('Go', array('name' => '', 'class' => 'btn'));
?>
<table>
    <tr><th>FirstName</th><th>LastName</th><th>Email</th><th>ImageUrl</th><th>UniqueId</th><th>Network</th><th></th></tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ));
    ?>
</table>
