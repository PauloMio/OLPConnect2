<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Ebook Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      padding: 20px;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 30px;
    }

    .card1 {
      display: flex;
      gap: 20px;
      align-items: flex-start;
    }

    .cover-photo {
      width: 300px;
      height: 400px;
      object-fit: cover;
      border-radius: 8px;
    }

    .details {
      flex: 1;
    }

    .details h2 {
      margin-top: 0;
    }

    .card2 {
      background: #121212; /* black/dark background */
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
      padding: 20px;
      margin-bottom: 30px;
      color: #ffffff; /* make text white */
    }

    .controls {
      position: sticky;
      top: 0;
      background: #121212; /* match the dark card background */
      padding: 10px 0;
      text-align: center;
      z-index: 10;
    }


    .controls button {
      padding: 8px 12px;
      margin: 0 5px;
      border: none;
      background-color: #007BFF;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    .controls button:hover {
      background-color: #0056b3;
    }

    .zoom-info {
      display: inline-block;
      margin: 0 10px;
      font-weight: bold;
    }

    #pdf-scroll-container {
      max-height: 800px;
      overflow-y: auto;
      padding: 10px 0;
    }

    #pdf-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    canvas {
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body oncontextmenu="return false;">

  <div class="card card1">
    @if($ebook->coverage)
      <img src="{{ url('storage/' . $ebook->coverage) }}" alt="Cover Photo" class="cover-photo">
    @else
      <img src="{{ url('imgcons/defaultcover.png') }}" alt="Default Cover" class="cover-photo">
    @endif

    <div class="details">
      <h2>{{ $ebook->title }}</h2>
      <p><strong>Description:</strong> {{ $ebook->description }}</p>
      <p><strong>Edition:</strong> {{ $ebook->edition }}</p>
      <p><strong>Category:</strong> {{ $ebook->category }}</p>
      <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
      <p><strong>Copyright Year:</strong> {{ $ebook->copyrightyear }}</p>
      <p><strong>Location:</strong> {{ $ebook->location }}</p>
    </div>
  </div>

  <div class="card2">
    @if($ebook->pdf)
      <div class="controls">
        <button onclick="zoomOut()">-</button>
        <span class="zoom-info" id="zoom-info">100%</span>
        <button onclick="zoomIn()">+</button>
      </div>

      <div id="pdf-scroll-container">
        <div id="pdf-container"></div>
      </div>
    @else
      <p>No PDF available.</p>
    @endif
  </div>

  <!-- PDF.js -->
  <script src="{{ asset('js/pdf.min.js') }}"></script>
<script>
  @if($ebook->pdf)
    const url = "{{ url('storage/' . $ebook->pdf) }}";

    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('js/pdf.worker.min.js') }}";


      const container = document.getElementById('pdf-container');
      let scale = 1.25;
      let pdfDoc = null;

      function renderAllPages(pdf) {
        container.innerHTML = '';
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
          pdf.getPage(pageNum).then(page => {
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            page.render({
              canvasContext: ctx,
              viewport: viewport
            });

            container.appendChild(canvas);
          });
        }
      }

      function zoomIn() {
        scale = Math.min(scale + 0.25, 3);
        document.getElementById('zoom-info').textContent = Math.round(scale * 100) + "%";
        renderAllPages(pdfDoc);
      }

      function zoomOut() {
        scale = Math.max(scale - 0.25, 0.5);
        document.getElementById('zoom-info').textContent = Math.round(scale * 100) + "%";
        renderAllPages(pdfDoc);
      }

      pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        renderAllPages(pdfDoc);
      });
    @endif
  </script>
</body>
</html>
