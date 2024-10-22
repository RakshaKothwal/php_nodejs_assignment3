const express = require('express');
const axios = require('axios');
const app = express();
const port = 3000;

app.get('/api/students', async (req, res) => {
    try {
        
        const response = await axios.get('http://localhost:8082/php_api/students.php');
        
       
        res.json(response.data);
    } catch (error) {
       
        console.error("Error fetching data from PHP API: ", error);
        res.status(500).send("Error fetching data from PHP API");
    }
});


app.listen(port, () => {
    console.log(`Express server is listening at http://localhost:${port}`);
});
