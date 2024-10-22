const express = require('express');
const app = express();
const port = 3000;


app.get('/api/students', (req, res) => {
    res.json([
        { student_id: "S23041", name: "Raksha", age: 21, class: "ICT" },
        { student_id: "S23042", name: "Anjali", age: 24, class: "IT" },
        { student_id: "S23043", name: "Kajal", age: 25, class: "ICT" }
    ]);
});

app.listen(port, () => {
    console.log(`Express API listening on http://localhost:${port}`);
});
