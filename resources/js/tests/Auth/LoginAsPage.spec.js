import { describe, expect, it } from "vitest";
import LoginAsPage from "../pages/Auth/LoginAsPage.vue"
import { render, screen } from "@testing-library/vue";


describe('LoginAsPage', () => {
    it("have all login option", () => {
        render(LoginAsPage);
        const element = screen.getByText("User");
        const element2 = screen.getByText("Admin");
        const element3 = screen.getByText("Resolver");
        expect(element).toBeInTheDocument();
        expect(element2).toBeInTheDocument();
        expect(element3).toBeInTheDocument();
    })
});


