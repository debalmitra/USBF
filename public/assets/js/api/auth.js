import { apiRequest } from "./request.js";

export async function login(username, password) {
  return await apiRequest("/api/auth/login", {
    method: "POST",

    headers: {
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      username,
      password,
    }),
  });
}
