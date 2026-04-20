import React, { useState } from "react";
import "./App.css";

function App() {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState("");
  const [response, setResponse] = useState("");

  const baseUrl = "https://cicd-production-479b.up.railway.app"; // Change to your Laravel URL
  const fakeLogin = async (email) => {
    setResponse("");
    try {
      const res = await fetch(`${baseUrl}/api/fake-saml-login`, {
        method: "POST",
        credentials: "include", // Important to include cookies
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email }),
      });

      const data = await res.json();
      setToken(data.token);

      if (res.ok) {
        // Fetch current user info
        const meRes = await fetch(`${baseUrl}/api/me`, {
          credentials: "include",
          headers: {
            "Authorization": `Bearer ${token}`,
          },
        });
        const meData = await meRes.json();
        setUser(meData);
        setResponse("Logged in successfully");
      } else {
        setResponse(data.message || "Login failed");
      }
    } catch (err) {
      setResponse(err.message);
    }
  };

  const callApi = async (endpoint) => {
    setResponse("");
    try {
      const res = await fetch(`${baseUrl}${endpoint}`, {
        credentials: "include",
        headers: {
          "Authorization": `Bearer ${token}`,
        },
      });
      const data = await res.json();
      setResponse(JSON.stringify(data, null, 2));
    } catch (err) {
      setResponse(err.message);
    }
  };

  return (
    <div style={{ padding: "20px", fontFamily: "Arial" }}>
      <h1>Fake SAML Login Demo</h1>

      <div style={{ marginBottom: "10px" }}>
        <button onClick={() => fakeLogin("admin@example.co")}>
          Fake SAML Login as Admin
        </button>{" "}
        <button onClick={() => fakeLogin("manager@example.com")}>
          Fake SAML Login as Manager
        </button>{" "}
        <button onClick={() => fakeLogin("user@example.com")}>
          Fake SAML Login as User
        </button>
      </div>

      {user && (
        <div style={{ marginBottom: "10px" }}>
          <h3>Current User:</h3>
          <p>ID: {user.id}</p>
          <p>Name: {user.name}</p>
          <p>Email: {user.email}</p>
          <p>Role: {user.role}</p>
        </div>
      )}

      <div style={{ marginBottom: "10px" }}>
        <button onClick={() => callApi("/api/admin")}>Call Admin API</button>{" "}
        <button onClick={() => callApi("/api/manager-or-admin")}>
          Call Manager/Admin API
        </button>
      </div>

      {response && (
        <pre style={{ background: "#f0f0f0", padding: "10px" }}>{response}</pre>
      )}
    </div>
  );
}

export default App;
