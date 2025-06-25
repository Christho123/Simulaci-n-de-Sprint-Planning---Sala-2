require('dotenv').config();
const nodemailer = require('nodemailer');

const sendEmail = async (to, subject, text) => {
  const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'clinicasenati@gmail.com',
      pass: 'aaos kdto wfzb wfct',
    },
  });

  await transporter.sendMail({
    from: `"Clinica Senati" <${process.env.EMAIL_USER}>`,
    to,
    subject,
    text,
  });
};

module.exports = sendEmail;
