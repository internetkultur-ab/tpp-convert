<!DOCTYPE html>
<html lang="se">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Filkonvertering</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css" />
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script
      src="https://unpkg.com/htmx.org@1.9.9"
      integrity="sha384-QFjmbokDn2DjBjq+fM+8LUIVrAgqcNW2s0PjAxHETgRn9l4fvX31ZxDxvwQnyMOX"
      crossorigin="anonymous"
    ></script>
    <meta
      name="description"
      content="Ladda upp en ljudfil för att konvertera den till rätt format för Telia Touchpoint Plus."
    />
    <meta property="og:title" content="Filkonvertering" />
    <meta
      property="og:description"
      content="Ladda upp en ljudfil för att konvertera den till rätt format för Telia Touchpoint Plus."
    />
    <meta property="og:site_name" content="Internetkultur AB" />
    <meta property="og:locale" content="sv_SE" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://tpp.internetkultur.se" />
  </head>
  <body>
    <main>
      <section>
        <form
          id="form"
          hx-encoding="multipart/form-data"
          hx-post="/convert.php"
          hx-target="#result"
        >
          <header>
            <h1>Filkonvertering</h1>
            <p>
              Filen du laddar upp här konverteras till det format som Telia
              Touchpoint Plus kräver.
            </p>
          </header>
          <label for="email">Din mejladress:</label>
          <input type="email" name="email" />
          <label for="file">Din inspelning:</label>
          <input type="file" name="file" accept="accept="audio/*" /><br />
          <button>Konvertera</button><br />
          <p id="result"></p>
          <p>Filen raderas från servern vid midnatt.</p>
        </form>
      </section>
    </main>
    <footer>
      <hr />
      <p>
        En tjänst från
        <a href="https://internetkultur.se"
          >Alex Nilsson Internetkultur AB &nearr;</a
        >
      </p>
    </footer>
    <!-- 100% privacy-first analytics -->
    <script
      async
      defer
      src="https://scripts.simpleanalyticscdn.com/latest.js"
    ></script>
    <noscript
      ><img
        src="https://queue.simpleanalyticscdn.com/noscript.gif"
        alt=""
        referrerpolicy="no-referrer-when-downgrade"
    /></noscript>
  </body>
</html>
