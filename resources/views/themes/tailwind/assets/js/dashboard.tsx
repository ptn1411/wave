import React from "react";
import { createRoot } from "react-dom/client";
import Home from "./pages/Home";

function init() {
    const container = document.getElementById("root");
    if (!container) {
        throw new Error("Can not find #root");
    }

    const root = createRoot(container);

    root.render(<Home />);
}
init();
