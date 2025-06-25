const express = require('express');
const sendEmail = require('./sendEmail');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors());

app.post('/api/send-email', async (req, res) => {
    const { email, mensaje } = req.body;
    if (!email || !mensaje) {
        return res.status(400).json({ error: 'Faltan datos' });
    }
    try {
        await sendEmail(email, 'Mensaje automático', mensaje);
        res.json({ success: true });
    } catch (error) {
        res.status(500).json({ error: 'Error al enviar el correo' });
    }
});

app.listen(3000, () => {
    console.log('Servidor escuchando en http://localhost:3000');
});