// src/index.js

const { render, useState } = wp.element;

function App() {
  const [checked, setChecked] = useState(false);
  const [activeTab, setActiveTab] = useState("tab1");

  const tabs = [
    { name: "tab1", title: "Tab 1" },
    { name: "tab2", title: "Tab 2" },
    // Add more tabs as needed
  ];

  return (
    <div>
      <h2>Tabbed Settings</h2>
      {tabs.map((tab) => (
        <button key={tab.name} onClick={() => setActiveTab(tab.name)}>
          {tab.title}
        </button>
      ))}
      {activeTab === "tab1" && (
        <div>
          <h3>Tab 1 Content</h3>
          <label>
            <input
              type="checkbox"
              checked={checked}
              onChange={(e) => setChecked(e.target.checked)}
            />
            Check me
          </label>
        </div>
      )}
      {activeTab === "tab2" && (
        <div>
          <h3>Tab 2 Content</h3>
          {/* Add content for Tab 2 here */}
        </div>
      )}
      {/* Add more tab content as needed */}
    </div>
  );
}

render(
  <App />,
  document.getElementById("obi-remove-post-types-from-search-options")
);
