<div class="container">
    <form class="mt-3 mb-5" action="/savedata" method="POST">
        <div class="form-group">
        <label for="uname">Name:</label>
        <input type="text" name="uname" class="form-control" placeholder="Enter your name" id="uname">
        </div>
        <div class="form-group">
            <label for="location">*Location:</label>
            <input type="text" name="location" class="form-control" placeholder="Enter you location/address" id="location" required>
        </div>
    <div class="form-group">
        <label for="phone">*Phone:</label>
        <input placeholder="Enter your phone number" type="number" name="phone" class="form-control" id="phone" required> 
    </div>
    <div class="form-group">
        <h4>Coordinates</h4>
        <label for="latitude">Latitude:</label>
        <input placeholder="Enter Latitude" type="text" name="latitude" class="form-control" id="latitude">
        <label for="lonngitude">Longitude:</label>
        <input placeholder="Enter Longitude" type="text" name="longitude" class="form-control" id="longitude"> 
    </div>
    <div class="btn btn-info" onclick="getLocation()">Get location coordinates</div>
<br/>
        <button type="submit" class="btn btn-primary btn-lg mt-3 mb-5">Submit</button>
    </form>
</div>