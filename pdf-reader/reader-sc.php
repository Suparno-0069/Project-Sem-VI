<?php
if (isset($_POST['ebread'])) {

    $url = $_POST["url"];
    echo "
    const url = '$url';
    
    let pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null,
        scaleMultiplier = 0.8;
    
    const scale = 1.0,
        canvas = document.querySelector('#pdf-render'),
        ctx = canvas.getContext('2d');
    
    
    
    const renderPage = num => {
        pageIsRendering = true;
    
        pdfDoc.getPage(num).then(page => {
            // console.log(page);
            const viewport = page.getViewport({
                scale
            });
            canvas.height = viewport.height;
            canvas.width = viewport.width;
    
    
            const renderCtx = {
                canvasContext: ctx,
                viewport
            }
    
    
            page.render(renderCtx).promise.then(() => {
                pageIsRendering = false;
    
                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });
    
            document.querySelector('#page-num').textContent = num;
        });
    };
    
    
    const queueRenderPage = num => {
        if (pageIsRendering) {
            pageNumIsPending = num;
        } else {
            renderPage(num);
        }
    }
    
    
    const showPrevPage = () => {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }
    
    const showNxtPage = () => {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }
    
    pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            // console.log(pdfDoc);
    
            document.querySelector('#page-count').textContent = pdfDoc.numPages;
    
            renderPage(pageNum)
    
        })
        .catch(err => {
            const div = document.createElement('div');
            div.className = 'error';
            div.appendChild(document.createTextNode(err.message));
            document.querySelector('body').insertBefore(div, canvas);
            document.querySelector('.top-bar').style.display = 'none';
        });
    
    
    var keyListener = function(e) {
        if ((e.keyCode || e.which) == 37) {
            showPrevPage();
        }
    
        if ((e.keyCode || e.which) == 39) {
            showNxtPage();
        }
    }
    document.addEventListener('keyup', keyListener, false);
    
    
    document.querySelector('#prev-page').addEventListener('click', showPrevPage);
    document.querySelector('#nxt-page').addEventListener('click', showNxtPage);
    ";
}
