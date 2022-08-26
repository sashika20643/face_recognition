<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>ISA Project</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">



  <!-- Bootstrap core CSS -->
  <link href="{{asset('assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="{{asset('cover.css')}}" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">



  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">Welcome</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
          <a class="nav-link" href="{{Route('about')}}">About Us</a>
        </nav>
      </div>
    </header>

    <main class="px-3">
      <h1>Face Emotion Detect Web</h1>
      <p class="lead">This web can recognize your now situation by analizing your face emotions...</p>

    </main>
    <div>Let's Try it!</div>
    <button type="button" onclick="init(); this.disabled=true;" id="btn">Start</button>
    <div id="webcam-container"></div>
    <div id="label-container"></div>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">




      // model provided by Teachable Machine export panel
      const URL = "https://teachablemachine.withgoogle.com/models/GoDQ-TFal/";

      let model, webcam, labelContainer, maxPredictions;

      // Load the image model and setup the webcam
      async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(360, 360, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) { // and class labels
          labelContainer.appendChild(document.createElement("div"));
        }
      }

      async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
      }

      // run the webcam image through the image model
      async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        for (let i = 0; i < maxPredictions; i++) {
          const classPrediction =
            prediction[i].className + ": " + prediction[i].probability.toFixed(2);
          labelContainer.childNodes[i].innerHTML = classPrediction;
        }
      }
    </script>

    <footer class="mt-auto text-white-50">
      <p>ISA Group Project</p>
    </footer>
  </div>



</body>

</html>
