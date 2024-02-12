importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyAMVS3wzQL30I9DyGV85IC9CDfVDsM6ah0",
    authDomain: "proyecto4-ac1de.firebaseapp.com",
    projectId: "proyecto4-ac1de",
    storageBucket: "proyecto4-ac1de.appspot.com",
    messagingSenderId: "54211334008",
    appId: "1:54211334008:web:68c232361068a07148028d"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});
