<!DOCTYPE html>
<html>

<head>
    <title>Html2Pdf</title>
    <!-- <link rel="stylesheet" type="text/css" href="examples.css"> -->
    <style>
        h2{
            font-family: 'spirax';
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spirax&display=swap" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <!-- <script src='https://unpkg.com/jspdf@2.5.1/dist/jspdf.es.min.js'></script> -->

</head>

<body>
    <div id="html" style='position: absolute; left: 0; top: 0; bottom: 0; overflow: auto; width: 400px'>


        <h1>Html2Pdf</h1>
        <p>
            This demo uses Html2Canvas.js to render HTML. <br />Instead of using an HTML canvas however, a canvas
            wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF
            rendering methods.
        </p>
        <p>A PDF of this page will be inserted into the right margin.</p>
    <a id="clickbind" href="#">Click</a>

        <h2 style="font-family:'spirax'">Colors</h2>
        <p>
            <span style='color: red'>red</span> <span style='color: rgb(0, 255, 0)'>rgb(0,255,0)</span> <span
                style='color: rgba(0, 0, 0, .5)'>rgba(0,0,0,.5)</span> <span style='color: #0000FF'>#0000FF</span> <span
                style='color: #0FF'>#0FF</span>
        </p>

        <h2>Text Alignment</h2>
        <div style='text-align: left'>left</div>
        <div style='text-align: center'>center</div>
        <div style='text-align: right'>right</div>

        <h2>Margins and Padding</h2>
        <div style='background-color: red'>
            Red
            <div style='background-color: green; margin: 1em; padding: 1em;'>
                Green
                <div style='background-color: blue; margin: 1em'>Blue</div>
            </div>
        </div>

        <h2>Borders</h2>
        <div style='border: 1px solid black'>Single</div>
        <hr />
        <div style='border: 4px double black'>Double</div>

        <h2>Font Style</h2>
        <div style='font-style: normal'>Normal</div>
        <div style='font-style: italic'>Italic</div>
        <div style='font-style: oblique'>Oblique</div>
        <h2>Lists</h2>
        <ul>
            <li>apples</li>
            <li>oranges</li>
            <li>pears</li>
            <li>peaches</li>
            <li>lemons</li>
            <li>limes</li>
        </ul>

        <h2>Font Size</h2>
        <div style='font-size: 10px'>10px</div>
        <div style='font-size: 20px'>20px</div>
        <div style='font-size: 30px'>30px</div>

        <div style='font-size: 20pt'>20pt</div>
        <div style='font-size: 1em'>1em</div>
        <div style='font-size: 2em'>2em</div>

    </div>




    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->
<script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>


    <script>
        var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.html(document.getElementById('html'), {
            callback: function (pdf) {
                pdf.save("htm.pdf");
            }
        });
//         var doc = new jsPDF('p', 'pt', 'letter');

// doc.text(20, 20, 'This is the default font.')

// doc.setFont('courier')
// doc.setFontType('normal')
// doc.text(20, 30, 'This is courier normal.')

// doc.setFont('times')
// doc.setFontType('italic')
// doc.text(20, 40, 'This is times italic.')

// doc.setFont('helvetica')
// doc.setFontType('bold')
// doc.text(20, 50, 'This is helvetica bold.')

// doc.setFont('courier')
// doc.setFontType('bolditalic')
// doc.text(20, 60, 'This is courier bolditalic.')
// doc.save("a4.pdf");

// var doc = new jsPDF()

// doc.setFontSize(40)
// doc.text(35, 25, 'Paranyan loves jsPDF')
// doc.addImage(imgData, 'JPEG', 15, 40, 180, 160)

// var pdf = new jsPDF('p', 'pt', 'letter');
//   pdf.canvas.height = 72 * 11;
//   pdf.canvas.width = 72 * 8.5;

//   pdf.fromHTML(document.body);

//   pdf.save('test.pdf');


        // );

// Landscape export, 2×4 inches
// function onClick() {

// };

var element = document.getElementById("clickbind");
element.addEventListener("click", onClick);
    </script>
</body>


</html>