  <head>
    <title>AJAX Quotes</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

        /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
            text-shadow: 4px 4px 4px #aaa;
            font-size:50px;
        }

        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
      body {
        background-color:beige;
        font-size:25px;
        font-family: 'Bebas Neue', sans-serif;
      }

      html {
        text-align:center;
        padding-top: 200px;
        
      }

      

    </style>
  </head>
  <body>
   
    <h1>AJAX Quotes</h1>
    <p>Random quote is generated every 5 seconds</p>
    <div id="quoteContainer">Quote goes here</div>
    <p>Experience the power of AJAX technology as you explore a dynamic<br> web page that effortlessly fetches random quotes from a PHP server. <br>Witness firsthand how AJAX transforms the user experience by seamlessly <br>updating content, providing an engaging and ever-changing interface.</p>
    <script>

      var counter = 0;
      function getRandomQuote(){
        var fonts = ["Qwitcher Grypen", "Tulpen One", "Shadows Into Light"];
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET','random-quotes.php',true);
        
        xhr.onload = function(){
          //code on return of data goes here
          if(xhr.status >= 200 && xhr.status < 300){//good data returned, show it!
            //document.querySelector("#quoteContainer").innerText = xhr.responseText;

            var quoteContainer = document.querySelector("#quoteContainer")
            quoteContainer.innerText = xhr.responseText;
            quoteContainer.style.display = "block";
            quoteContainer.classList.add("fade-in");
            
            quoteContainer.style.fontFamily = fonts[counter];
            counter++;
            if(counter >= fonts.length){
              counter = 0;
            }

            setTimeout(function(){
              quoteContainer.classList.remove("fade-in");
            },1000);
          }else{//something went wrong, give feedback
            document.querySelector("#quoteContainer").innerText = "Failed to fetch quote: " + xhr.status;
          }
        };
        xhr.onerror = function(){
          //code on error goes here
          alert("Oh oh!");
        };
        //sends data to server
        xhr.send();
      }

      function displayRandomQuote(){
        //initial page load
        getRandomQuote();
        
        //run again at intervals
        setInterval(getRandomQuote,5000);
      }
      //run on page load
      displayRandomQuote();
    </script>
  </body>
</html>
