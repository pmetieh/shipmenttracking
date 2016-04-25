+(function () {
    var input = document.getElementById("customer-pic-file"),
        formdata = false;

    function showUploadedItem (source) {
        /*var list = document.getElementById("image-list"),
            li   = document.createElement("li"),
            img  = document.createElement("img");*/
        //get the existing image element
        var img  = document.getElementById("customer-pic");
        img.src = source;
        img.height = 300;
        img.width = 300;

        /*li.appendChild(img);
        list.appendChild(li);;*/
    }

    //if FormData is supported by the XMLHttpRequest2 object
    //then hide the display button
    if (window.FormData) {
        formdata = new FormData();
       // document.getElementById("btn").style.display = "none";
    }

    input.addEventListener("change", function (evt) {
     //   document.getElementById("response").innerHTML = "Uploading . . ."
     //   alert('Uploading ...');
        var i = 0, len = this.files.length, img, reader, file;
        //alert('Number of attached file(s) '+len);
        for ( ; i < len; i++ ) {
            file = this.files[i];
           // alert('Type of variable '+file);
            //if the browser supports the file reader object
            //then show the attached image when the FileReader object's
            //onloadend event fires

            if (!!file.type.match(/image.*/)) {
                if ( window.FileReader ) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                      //  alert('The uploaded filename is '+file.fileName);
                        showUploadedItem(e.target.result, file.fileName);
                    };
                    reader.readAsDataURL(file);
                }
                if (formdata) {
                    formdata.append("customer-pic-file", file);
                }
            }
        }

        //call the php upload script via aJax
        // and post the form contents to it
        if (formdata) {
            $.ajax({
                url: "",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (res) {
                   // document.getElementById("response").innerHTML = res;
                }
            });
        }
    }, false);
}());

