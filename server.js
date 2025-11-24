import express from "express";
import Twilio from "twilio";
import cors from "cors";

const app = express();
app.use(express.json());
app.use(cors());

const accountSid = process.env.AC43eeeeeeeeeeeeeeeeeeeeeeeeeeee;
const authToken  = process.env.e4bcccccccccccccccccccccccccccccc;
const serviceSid = process.env.VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa;

const client = Twilio(accountSid, authToken);

app.post("/otp", async (req, res) => {
  const { userSid } = req.body;

  try {
    const data = await client.verify.v2
      .services(serviceSid)
      .verificationChecks.list({ limit: 1 });

    res.json(data);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.listen(3000, () => console.log("API rodando na porta 3000"));
