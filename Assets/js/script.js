function finishTask(id){
    action = confirm("Mark Task Finished?");
    if(action){
        req = {
            action: "markFinished",
            id: id 
        };
        fetch("/Api/index.php", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(req)
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (result) {
            console.log(JSON.stringify(result));
            if(result.state == 'success'){
                console.log("Hi");
                window.location.href = "/posts";
            }
        })
        .catch (function (error) {
            console.log('Request failed', error);
        });
    }
}

function incompleteTask(id){
    action = confirm("Mark Task Incomplete?");
    if(action){
        req = {
            action: "markIncomplete",
            id: id 
        };
        fetch("/Api/index.php", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(req)
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (result) {
            console.log(JSON.stringify(result));
            if(result.state == 'success'){
                console.log("Hi");
                window.location.href = "/finished";
            }
        })
        .catch (function (error) {
            console.log('Request failed', error);
        });
    }
}

var lat = document.getElementById("latitude");
var lng = document.getElementById("longitude");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    lat.value = position.coords.latitude;
    lng.value = position.coords.longitude; 
}