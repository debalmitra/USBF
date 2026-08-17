export async function apiRequest(url, options = {}) {
  console.log("[API] Request:", url);

  const response = await fetch(url, {
    ...options,

    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
      ...(options.headers || {}),
    },
  });

  console.log("[API] HTTP status:", response.status);

  const raw = await response.text();

  console.log("[API] RAW RESPONSE:", raw);

  let data;

  try {
    data = JSON.parse(raw);
  } catch (error) {
    console.error("[API] JSON PARSE ERROR:", error);

    throw new Error("Invalid server response.");
  }

  console.log("[API] JSON:", data);

  return {
    ok: response.ok,
    status: response.status,
    ...data,
  };
}
