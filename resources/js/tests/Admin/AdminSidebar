import { render, screen } from '@testing-library/vue'
import { describe, expect, it, vi } from 'vitest'
import SidebarItemVue from '../../components/Sidebar/SidebarItem.vue';
import { createTestingPinia } from "@pinia/testing";
import { useSidebarStore } from '@/store/sidebar';
import SidebarItemVue from '../../components/Sidebar/SidebarItem.vue';



vi.mock("@/store/sidebar", () => ({
    useSidebarStore() {
      return {
        isSidebarOpen : 'aa',
        selected : 'aa',
        page : 'aa',
      };
    },
  }));
  
  const setup = () => {
    return render(SidebarItemVue, {
        props:{
            item: {
                icon: 'aa',
                label: 'aaa',
                route: '/'
            }
        },
      global: {
        plugins: [createTestingPinia({ createSpy: vi.fn })],
      },
    });
  };
  
  afterEach(() => {
    vi.clearAllMocks();
  });


