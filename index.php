<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IN Module A - Speed Test</title>
  </head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: sans-serif;
      background: linear-gradient(to top, white, rgb(122, 193, 255));
      min-height: 100vh;
      margin: 0;
      padding: 4rem;
    }
    .container {
      max-width: 1280px;
      margin: auto;
      text-align: center;
    }
    .cards {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
      margin: 1rem 1rem;
    }
    a {
      text-decoration: none;
      color: inherit;
      background-color: white;
      padding: 4rem;
      border-radius: 0.5rem;
      display: block;
      width: fit-content;
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.226);
      transition: all 150ms ease;
      border: 1px solid gray;
      font-size: 1.5rem;
    }
    a:hover {
      transform: scale(1.05) translateY(-5px);
      background-color: orangered;
      color: white;
      border: 1px solid orangered;
      box-shadow: 0 40px 40px rgba(0, 0, 0, 0.226);
    }
    a:active {
      transform: scale(1);
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.226);
    }
    h2 {
      opacity: 0.75;
    }
    h3 {
      margin-top: 3rem;
    }
  </style>
  <body>
    <div class="container">
      <h1>Speed Test Module</h1>
      <h2>India</h2>
      <h3>A. Design Implementation</h3>
      <div class="cards">
        <a href="A4">A4</a>
        <a href="A6">A6</a>
        <a href="A9">A9</a>
      </div>
      <h3>B. Front-end Development</h3>
      <div class="cards">
        <a href="B2">B2</a>
        <a href="B5">B5</a>
        <a href="B6">B6</a>
      </div>
      <h3>C. Back-end Development</h3>
      <div class="cards">
        <a href="C2">C2</a>
        <a href="C8">C8</a>
        <a href="C9">C9</a>
      </div>
    </div>
  </body>
</html>
