import express from "express";
import Twilio from "twilio";
import cors from "cors";

const app = express();
app.use(express.json());
app.use(cors());

const accountSid = process.env.AC43ebd4aa00d8a466a07cbb0c125a3ba1;
const authToken  = process.env.e4bc0842a7dddc622dc8b53954fa7f24;
const serviceSid = process.env.VAba0c04e2fc3d6f716d8961e5eaf59e79;

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
