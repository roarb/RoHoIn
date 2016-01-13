<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testing</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <style>
        body {margin:0; overflow:hidden;}
        #webglviewer {bottom:0; left:0; position:absolute; right:0; top:0;}
    </style>
</head>
<body>

<div id="webglviewer"></div>
<div id="test"></div>

<script src="js/three.js"></script>
<script src="js/StereoEffect.js"></script>
<script src="js/DeviceOrientationControls.js"></script>
<script src="js/OrbitControls.js"></script>
<script src="js/helvetiker_regular.typeface.js"></script>
<script>
    var scene,
        camera,
        renderer,
        element,
        container,
        effect,
        clock,
        controls,
        stereo,
        stereoTexture,
        stereoMaterial,
        stereoGeometry;

    init();

    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(90, window.innerWidth / window.innerHeight, 0.001, 700);
        camera.position.set(0, 50, 0);
        scene.add(camera);

        renderer = new THREE.WebGLRenderer();
        element = renderer.domElement;
        container = document.getElementById('webglviewer');
        container.appendChild(element);

        effect = new THREE.StereoEffect(renderer);

        // Our initial control fallback with mouse/touch events in case DeviceOrientation is not enabled
        controls = new THREE.OrbitControls(camera, element);
        controls.target.set(
            camera.position.x + 0.00001,
            camera.position.y,
            camera.position.z
        );
        controls.noPan = true;
        controls.noZoom = true;

        // Our preferred controls via DeviceOrientation
        function setOrientationControls(e) {
            if (!e.alpha) {
                return;
            }

            controls = new THREE.DeviceOrientationControls(camera, true);
            controls.connect();
            controls.update();

            element.addEventListener('click', fullscreen, false);

            window.removeEventListener('deviceorientation', setOrientationControls, true);
        }
        window.addEventListener('deviceorientation', setOrientationControls, true);

        // Lighting
        var light = new THREE.PointLight(0x999999, 1, 600);
        light.position.set(50, 50, 0);
        //scene.add(light);

        var lightScene = new THREE.PointLight(0x999999, 2, 100);
        lightScene.position.set(0, 5, 0);
        //scene.add(lightScene);

        //scene.add(new THREE.AmbientLight(0x404040));

        // floor texture
        //var floorTexture = THREE.ImageUtils.loadTexture('textures/united_states_wall_2002_us.jpg');
        //floorTexture.wrapS = THREE.RepeatWrapping;
        //floorTexture.wrapT = THREE.RepeatWrapping;
        //floorTexture.repeat = new THREE.Vector2(1, 1);
        //floorTexture.anisotropy = renderer.getMaxAnisotropy();

        //var floorMaterial = new THREE.MeshPhongMaterial({
        //    color: 0xffffff,
        //    specular: 0xffffff,
        //    shininess: 0,
        //    shading: THREE.FlatShading,
        //    map: floorTexture
        //});

        //var geometry = new THREE.PlaneBufferGeometry(1000, 1000);

        //var floor = new THREE.Mesh(geometry, floorMaterial);
        //floor.rotation.x = -Math.PI / 2;
        //scene.add(floor);

        //stereoTexture = THREE.ImageUtils.loadTexture('img/approach_to_battlefield-to-size.jpg');
        stereoTexture = THREE.ImageUtils.loadTexture('img/ore-docks-bay-of-marquette.jpg');
        stereoTexture.offset.set(.5, 0);
        stereoTexture.repeat.set(.5, 1);
        //stereoTexture = THREE.ImageUtils.loadTexture('textures/mountains.jpg');
        //stereoTexture.repeat = new THREE.Vector2(1, 1);
        //stereoTexture.anisotropy = renderer.getMaxAnisotropy();

        stereoMaterial = new THREE.MeshBasicMaterial({
            color: 0xffffff,
            shading: THREE.FlatShading,
            map: stereoTexture
        });

        //new THREE.Mesh(currentCityText, new THREE.MeshBasicMaterial({
        //    color: 0xffffff, opacity: 1
        //}));

        stereoGeometry = new THREE.PlaneBufferGeometry(100,100);

        stereo = new THREE.Mesh(stereoGeometry, stereoMaterial);
        stereo.position.x = 50;
        stereo.position.y = 50;
        stereo.position.z = 0.001;
        stereo.rotation.x = 0;
        stereo.rotation.y = -Math.PI / 2;
        scene.add(stereo);

        var reticle = new THREE.Mesh(new THREE.PlaneBufferGeometry(1, 1), new THREE.MeshBasicMaterial({
            color: 0xff0000, opacity: 1, shading: THREE.FlatShading
        }));

        reticle.position.y = 15;
        reticle.position.x = 10;
        reticle.position.z = 4;
        reticle.rotation.x = 0;
        reticle.rotation.y = 180;
        //scene.add(reticle);


        // need the clock & animate() == not sure why yet
        clock = new THREE.Clock();
        animate();
    }

    <?php /*
    function adjustToWeatherConditions() {
        var cityIDs = '';
        for (var i = 0; i < cities.length; i++) {
            cityIDs += cities[i][1];
            if (i != cities.length - 1) cityIDs += ',';
        }
        getURL('http://api.openweathermap.org/data/2.5/group?id=' + cityIDs + '&APPID=b5c0b505a8746a1b2cc6b17cdab34535', function(info) {
            cityWeather = info.list;

            lookupTimezones(0, cityWeather.length);
        });
    }

    function lookupTimezones(t, len) {
        var tz = new TimeZoneDB;

        tz.getJSON({
            key: "GPH4A5Q6NGI1",
            lat: cityWeather[t].coord.lat,
            lng: cityWeather[t].coord.lon
        }, function(timeZone){
            cityTimes.push(new Date(timeZone.timestamp * 1000));

            t++;
            if (t < len) lookupTimezones(t, len);
            else applyWeatherConditions();
        });
    }

    function applyWeatherConditions() {
        displayCurrentCityName(cities[currentCity][0]);

        var info = cityWeather[currentCity];

        particleRotationSpeed = info.wind.speed / 2; // dividing by 2 just to slow things down
        particleRotationDeg = info.wind.deg;

        var timeThere = cityTimes[currentCity] ? cityTimes[currentCity].getUTCHours() : 0,
            isDay = timeThere >= 6 && timeThere <= 18;

        if (isDay) {
            switch (info.weather[0].main) {
                case 'Clouds':
                    currentColorRange = [0, 0.01];
                    break;
                case 'Rain':
                    currentColorRange = [0.7, 0.1];
                    break;
                case 'Clear':
                default:
                    currentColorRange = [0.6, 0.7];
                    break;
            }
        } else {
            currentColorRange = [0.69, 0.6];
        }

        if (currentCity < cities.length-1) currentCity++;
        else currentCity = 0;

        setTimeout(applyWeatherConditions, 5000);
    }

    function displayCurrentCityName(name) {
        scene.remove(currentCityTextMesh);

        currentCityText = new THREE.TextGeometry(name, {
            size: 4,
            height: 1
        });
        currentCityTextMesh = new THREE.Mesh(currentCityText, new THREE.MeshBasicMaterial({
            color: 0xffffff, opacity: 1
        }));

        currentCityTextMesh.position.y = 10;
        currentCityTextMesh.position.z = 20;
        currentCityTextMesh.rotation.x = 0;
        currentCityTextMesh.rotation.y = -180;

        scene.add(currentCityTextMesh);
    }
    */ ?>
    function animate() {
        var elapsedSeconds = clock.getElapsedTime();

        if (elapsedSeconds > 2){
            //scene.remove(stereo);
            //stereo.material.map.dispose();
            //stereo.material.map = THREE.ImageUtils.loadTexture('textures/mountains.jpg');
            //scene.add(stereo);
            stereoTexture.offset.set(0, 0);
        }



        requestAnimationFrame(animate);

        update(clock.getDelta());
        render(clock.getDelta());
    }

    function resize() {
        var width = container.offsetWidth;
        var height = container.offsetHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();

        renderer.setSize(width, height);
        effect.setSize(width, height);
    }

    function update(dt) {
        resize();

        camera.updateProjectionMatrix();

        controls.update(dt);
    }

    function render(dt) {
        effect.render(scene, camera);
    }

    function fullscreen() {
        if (container.requestFullscreen) {
            container.requestFullscreen();
        } else if (container.msRequestFullscreen) {
            container.msRequestFullscreen();
        } else if (container.mozRequestFullScreen) {
            container.mozRequestFullScreen();
        } else if (container.webkitRequestFullscreen) {
            container.webkitRequestFullscreen();
        }
    }

    <?php /*
    function getURL(url, callback) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200){
                    callback(JSON.parse(xmlhttp.responseText));
                }
                else {
                    console.log('We had an error, status code: ', xmlhttp.status);
                }
            }
        }

        xmlhttp.open('GET', url, true);
        xmlhttp.send();
    } */ ?>
</script>

</body>
</html>