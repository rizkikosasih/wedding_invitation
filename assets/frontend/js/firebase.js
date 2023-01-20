// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
import {initializeApp} from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js"
import {getDatabase, ref, set, get, child, update, remove} from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js"

const firebaseConfig = {
     apiKey: "AIzaSyBowAZu0aHRhoaed4DmiOxUPqya1rrrNL4",
     authDomain: "wedding-ola.firebaseapp.com",
     databaseURL: "https://wedding-ola-default-rtdb.asia-southeast1.firebasedatabase.app",
     projectId: "wedding-ola",
     storageBucket: "wedding-ola.appspot.com",
     messagingSenderId: "978410763371",
     appId: "1:978410763371:web:9651fc1b2dd942a7d66d2e",
     measurementId: "G-P60ZBRC3CT"
}

// Initialize Firebase
const app = initializeApp(firebaseConfig)
const database = getDatabase(app)

const formComment = $('.form-comment'),
     listComment = $('.list-comment')

const writeComment = (name, message) => {
     let timestamp = new Date().getTime()
     set(ref(database, 'comment/' + timestamp), {
          name: name,
          message: message, 
     }).then( (res) => {
          console.log(res)
     })
}

$(function () {
     // Form Comment
     if (formComment.length) {
          $(document).on('submit', formComment, function () {
               let name = $('#name').val(),
                    message = $('#message').val()
               if (name && message) {
                    writeComment(name, message)
                    formComment[0].reset() 
               } else {
                    console.log('Name dan Message Tidak Boleh Kosong')
               }
               return false
          })
     } 

     // get(child(ref(database, "comment/"))).then((snapshot) => {
     // 	if (snapshot.exists()) {
     // 		console.log(snapshot.val());
     // 	} else {
     // 		console.log("No data available");
     // 	}
     // }).catch((error) => {
     // 	console.error(error);
     // })

     // fetchChat.on("child_added", function (snapshot) {
     //      let comment = snapshot.val(),
     //           message = `
     //           <div class="d-flex flex-row align-items-baseline comment-box">
     //                <div class="avatar bg-primary primary-text">
     //                <?= initialName($c->name) ?>
     //                </div>
     //                <div class="dialogbox w-100">
     //                <div class="body">
     //                     <span class="tip tip-left"></span>
     //                     <div class="message">
     //                               <div class="fw-bold"><?= $c->name ?></div>
     //                               <hr class="solid bc-primary my-1">
     //                               <span><?= html_entity_decode($c->message) ?></span>
     //                     </div>
     //                </div>
     //                </div>
     //           </div>
     //      `
     //      // append the message on the page
     //      listComment.html() += message;
     // })
})