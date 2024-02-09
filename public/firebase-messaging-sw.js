importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyA0sZg_qcyH3U96sXF34IYOIvh0tAxX21U",
    authDomain: "alarmas-02-02-2024.firebaseapp.com",
    projectId: "alarmas-02-02-2024",
    storageBucket: "alarmas-02-02-2024.appspot.com",
    messagingSenderId: "734912814529",
    appId: "1:734912814529:web:32ec2d241e14e693c5e340"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});
