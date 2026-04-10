import { createRoot } from "react-dom/client";
import "./frontend.scss";

document.addEventListener("DOMContentLoaded", function () {
  const divsToUpdate = document.querySelectorAll(".paying-attention-update-me");

  divsToUpdate.forEach(function (div) {
    const root = createRoot(div);
    root.render(<Quiz />);
  });
});

function Quiz() {
  return <div className="paying-attention-frontend">Hello from React</div>;
}
