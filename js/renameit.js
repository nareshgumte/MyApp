
function sendNotification(vid, vpath, ipath, fb_id) {
    var vpath1 = "http://www.youtube.com/watch?v=NUo8CKI34o4";
    var ipath1 = "http://www.fanwire.com/";
    var atch = {
        name: 'iRant',
        href: 'http://202.65.136.24/irant/rants/videopage.php?vid=' + vid + '&rantback=0',
        caption: 'Rename It Testing',
        description: 'This is The testing for Rename it Functionality',
        media: [{
                type: 'video',
                video_src: vpath1,
                preview_img: ipath1
            }]
    };
    FB.ui(
            {
                method: 'send', //'feed',//'apprequests', "send"
                //display: 'popup',
                to: ['100001521670408'],
                name: 'Rename It Funtionality',
                link: ipath1,
                message: "some message",
                /*  method: 'send',//"feed"
                 *  message:"some message",
                 name: 'Rename It Funtionality',
                 link: ipath1 ,
                 picture: ipath1,
                 caption: 'Reference Documentation',
                 description: 'Dialogs provide a simple, consistent interface for applications to interface with users.'
                 method: 'stream.publish',"stream.share"
                 message: ' ',
                 attachment: atch,
                 action_links: [
                 {
                 text: 'My Reviews', 
                 href: 'http://www.moviereviewsindia.com/User.aspx/Profile/1266802272'
                 }
                 ],
                 href: 'http://www.moviereviewsindia.com/Movie.aspx/Details/Raajneeti',
                 user_prompt_message: 'Share your thoughts about ' + 'Raajneeti - Movie Review'*/
            },
            function(response) {
                console.log(response)
                if (response && response.post_id) {
                    alert('Posted!');
                } else {
                    alert(' NOT Posted!');
                }
            }
    );

}

function loadData() {

    IN.API.Profile("me")
            .result(function(result) {

        // console.log(result.values[0].id)

    })
}
function successLoad() {
    console.log("shared successfully")
    alert("suuceess");
}
function erLoad() {
    console.log("shared failed")
    alert("suuceess");
}
function shareLinkedIn(text) {
    IN.API.Connections("me")
            .fields("id", "firstName", "lastName", "distance", "publicProfileUrl", "pictureUrl")
            .params({"count": 10})
            .result(function(result) {
        console.log(JSON.stringify(result));
        alert(JSON.stringify(result));
    });

    /*IN.UI.Share().params({
     title: "Testing Title",
     description: "Testing Description",
     url: "http://www.yahoo.com"
     }).place()*/
}
function onLinkedInLoad() {
    // Listen for an auth event to occur
    // IN.Event.on(IN, "auth", onLinkedInAuth);
    // IN.API.Profile("me").result(displayProfiles);//one member info
    IN.API.Profile("me", "url=http://www.linkedin.com/pub/mahesh-kondapalli/14/104/8a5").result(displayProfiles);//multiple member info

}


// 2. Runs when the Profile() API call returns successfully
/*
 only for one member information
 function displayProfiles(profiles) {
 member = profiles.values[0];
 document.getElementById("profiles").innerHTML = 
 "<p id=\"" + member.id + "\">Hello " +  member.firstName + " " + member.lastName + "</p>";
 }*/
/*
 multiple member infoirmation
 */
function displayProfiles(profiles) {
    console.log("Display Profile" + profiles);
    var profilesDiv = document.getElementById("profiles");

    var members = profiles.values;
    for (var member in members) {
        profilesDiv.innerHTML += "<p>Welcome " + members[member].firstName + " " + members[member].lastName + "</p>";
    }
}

function onLinkedInLoad() {

    // Listen for an auth event to occur
    IN.Event.on(IN, "auth", onLinkedInAuth);

}

function onLinkedInAuth() {

    // After they've signed-in, print a form to enable keyword searching
    var div = document.getElementById("sendMessageForm");

    div.innerHTML = '<h2>Send a Message To Yourself</h2>';
    div.innerHTML += '<form action="javascript:SendMessage();">' +
            '<input id="message" size="30" value="You are awesome!" type="text">' +
            '<input type="submit" value="Send Message!" /></form>';
}

function SendMessage(keywords) {
    console.log("sendmessagecalled");
    // Call the Message sending API with the viewer's message
    // On success, call displayMessageSent(); On failure, do nothing.

    var message = keywords;//document.getElementById('message').value; 
    var BODY = {
        "recipients": {
            "values": [{
                    "person": {
                        "_path": "/people/~",
                    }
                }]
        },
        "subject": "JSON POST from JSAPI",
        "body": message
    }
    IN.API.Raw("/people/~/connections")
            .method("GET")
            .body(JSON.stringify(BODY))
            .result(displayMessageSent)
            .error(function error(e) {
        alert("No dice")
    });
}

function displayMessageSent() {
    var div = document.getElementById("sendMessageResult");
    div.innerHTML += "Yay!";
}

/*to get all freinds id and emmaiul idi s
 *  FB.init({
 appId: '327963737297629',
 status: true,
 cookie: true,
 xfbml: true
 });
 
 FB.getLoginStatus(function (response) {
 if (response.status === 'connected') {
 GetData();
 } else {
 Login();
 }
 });
 
 function Login() {
 FB.login(function (response) {
 if (response.authResponse) {
 GetData();
 }
 }, { scope: 'email' });
 }
 
 function GetData() {
 //Get user data
 FB.api('/me', function (response) {
 //Sender
 var sender = response.email;
 console.log(sender);
 //Get friends
 FB.api('/me/friends', function (response) {
 
 //Recepients array
 var recipients = [];
 var length = response.data.length;
 var counter = 0;
 
 //Loop through friends
 for (i = 0; i < length; i++) {
 var id = response.data[i].id;
 
 //Get friend data
 FB.api('/' + id, function (response) {
 var recipient = "";
 
 //User got a username, take username
 if (response.username) {
 recipient = response.username + '@facebook.com';
 }
 //No username, take id
 else {
 recipient = response.id + '@facebook.com';
 }
 console.log(recipient);
 console.log(response.id);
 //Add e-mail address to array
 recipients.push(recipient);
 
 counter++;
 //last email -> send
 if (counter == length) {
 SendEmail(sender, recipients);
 }
 });
 }
 });
 });
 }
 
 function SendEmail(sender, recipients) {
 //Call webservice to send e-mail e.g.
 $.ajax({ type: 'POST',
 contentType: 'application/json; charset=utf-8',
 dataType: 'json',
 url: '#WEBSERVICE#',
 data: '{ sender:"' + sender + '", recipients: ["' + recipients.join('","') + '"] }',
 success: function (response) {
 //do something
 }
 });
 }
 *
 **/
///*testestt*/
//FB.getLoginStatus(function(response) {
//    if (response.status === 'connected') {
//        //Get user data
//        getUsContacts();
//    } else {
//        Login();
//    }
//});
//
//function Login() {
//    FB.login(function(response) {
//        if (response.authResponse) {
//            //Get user data
//            getUsContacts();
//        }
//    }, {
//        scope: 'email'
//    });
//}
///*testesting tend*/

function GetFBContacts() {
    FB.init({
        appId: "327963737297629", //fb_id, 
        cookie: true,
        status: true,
        xfbml: true
    });
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //Get user data
            getUsContacts();
        } else {
            Login();
        }
    });
}
function getUsContacts() {
    FB.api('/me', function(response) {
        //Sender
        var sender = response.email;
        console.log(sender);
        //Get friends
        FB.api('/me/friends', function(response) {

            //Recepients array
            var recipients = [];
            var length = response.data.length;
            var counter = 0;

            //Loop through friends
            for (i = 0; i < length; i++) {
                var id = response.data[i].id;

                //Get friend data
                FB.api('/' + id, function(response) {
                    var recipient = "";

                    //User got a username, take username
                    if (response.username) {
                        recipient = response.username + '@facebook.com';
                    }
                    //No username, take id
                    else {
                        recipient = response.id + '@facebook.com';
                    }
                    console.log(recipient);
                    console.log(response.id);
                    //Add e-mail address to array
                    recipients.push(recipient);
//"https://graph.facebook.com/" . $user_friend['id'] . "/picture?type=large";
                    counter++;
                    //last email -> send
                    if (counter == length) {
                        //  SendEmail(sender, recipients);
                    }
                });
            }
        });
    });
}

function openInvitaion(type,id) {
    var newwindow = window.open('http://localhost/IntroPoc/common/sendFbInvitation?type='+type+'&id='+id, 'Invitation', 'width=500,height=400,toolbar=0,menubar=0,location=1,status=1,scrollbars=0,resizable=1,left=0,top=0');
    if (window.focus) {
        newwindow.focus()
    }
    
    return false;
}