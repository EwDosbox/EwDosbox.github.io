{
  description = "Jekyll development environment";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
  };

  outputs = {
    self,
    nixpkgs,
    ...
  }: let
    supportedSystems = ["x86_64-linux" "aarch64-linux" "x86_64-darwin" "aarch64-darwin"];
    forEachSystem = f: nixpkgs.lib.genAttrs supportedSystems (system: f system);
  in {
    devShells = forEachSystem (system: let
      pkgs = import nixpkgs {inherit system;};
    in {
      default = pkgs.mkShell {
        buildInputs = with pkgs; [
          ruby
          bundler
          zlib
          openssl
          libffi
          pkg-config
        ];
        shellHook = ''
          # Keep gems isolated inside the project directory
          export GEM_HOME="$PWD/.gem"
          export PATH="$GEM_HOME/bin:$PATH"
          echo "Ruby & Jekyll development environment loaded."
        '';
      };
    });
  };
}
